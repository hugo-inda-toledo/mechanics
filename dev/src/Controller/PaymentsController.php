<?php
namespace App\Controller;
use Ideauno\RequestStatus;
use Ideauno\ServicesModStatus;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;
use Freshwork\Transbank\Log\LoggerFactory;
use Freshwork\Transbank\Log\TransbankCertificationLogger;
use Freshwork\Transbank\Log\LogHandler;
use Freshwork\Transbank\Log\LoggerInterface;
use Cake\Routing\Router;
use Cake\Core\Configure;
use App\Utility\MainPaymentVoucherPdf;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Message');
        $this->Auth->allow(['webpay','confirm','end','rejection']);
    }

    public function rejection($id=0,$msg=null){
        //esta es la funcion que va a desplegar cualquier tipo de rechazo de transbank
        //sea lo que sea siempre es el mismo mensaje, que esta en la descripcion de los manuales de transbank
        //para la pagina de rechazo
        //debug($msj); die;
        //$this->redirect();
        $this->_send_mail($id);
        $this->redirect('http://localhost:3000/#/pages/solicitar-servicios/webpay-rejection/'.$id);
    }
    public function webpay($payment_id = null,$token = null)
    {
        $token = str_replace('__', '', $token);
        $user_id =  __token_user_id($token);
        $this->viewBuilder()->layout('ajax');
        if($user_id>0){
            $payment = $this->Payments->get($payment_id);
            if(!empty($payment)){
                if($payment->paid == 1 || !empty($payment->responseCode)) {
                    $this->rejection($payment_id);//ya con pago
                } else {
                    //inicio no tiene pago realizado
                    LoggerFactory::setLogger(new TransbankCertificationLogger('/var/www/nginx-default/logs/transbank/'));
                    $bag = CertificationBagFactory::integrationWebpayNormal();
                    $plus = TransbankServiceFactory::normal($bag);

                    $fullLink_confirm =  Router::url(['controller' => 'Payments','action' => 'confirm'],TRUE);
                    $fullLink_end =  Router::url(['controller' => 'Payments','action' => 'end'],TRUE);

                    $plus->addTransactionDetail($payment->amount, $payment->id);
                    try {
                        $response = $plus->initTransaction($fullLink_confirm, $fullLink_end);
                        $this->request->data['token'] = $response->token;
                        $payment = $this->Payments->patchEntity($payment, $this->request->data);
                        $resp = $this->Payments->save($payment);

                        $this->set('url_tb', $response->url);
                        $this->set('token', $response->token);
                    } catch (\SoapFault $e) {
                        //debug(json_encode($e)); die;
                        $this->rejection($payment_id,'1');//ya con pago
                    }
                    //fin no tiene pago realizado
                }
            } else {
                $this->rejection($payment_id,'2');
            }
        }else{
            $this->rejection($payment_id,'0');
        }
    }//end webpay


    /*public function webpay($request_id = null)
    {
        $this->viewBuilder()->layout('ajax');
        $orden = $this->Payments->Requests->get($request_id, [
            'contain' => []
        ]);

        $payment = $this->Payments->find('all',['conditions' => ['request_id' => $request_id],'order' => ['created' => 'desc']])->first();

        if(!empty($payment)){
            if($payment->paid) {
                die('ya está pagado, redireccionar donde corresponda');
            } else {
                if(!empty($payment->responseCode)) {
                    $payment = $this->Payments->newEntity();
                }
            }
        } else {
            $payment = $this->Payments->newEntity();
        }

        LoggerFactory::setLogger(new TransbankCertificationLogger('/var/www/nginx-default/logs/transbank/'));
        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);

        $fullLink_confirm =  Router::url(['controller' => 'Payments','action' => 'confirm'],TRUE);
        $fullLink_end =  Router::url(['controller' => 'Payments','action' => 'end'],TRUE);

        $plus->addTransactionDetail($orden->total_price, $orden->id);
        try {
            $response = $plus->initTransaction($fullLink_confirm, $fullLink_end);
            $payment->request_id = $orden->id;
            $payment->token = $response->token;
            $payment->payment_method_id = 1;
            $payment->user_id = $orden->client_id;
            $resp = $this->Payments->save($payment);

            $this->set('url_tb', $response->url);
            $this->set('token', $response->token);
        } catch (\SoapFault $e) {
            debug(json_encode($e)); die;
        }
    }*/

    public function confirm($id = null)
    {
        $this->autoRender = false;
        LoggerFactory::setLogger(new TransbankCertificationLogger('/var/www/nginx-default/logs/transbank/'));
        $bag = CertificationBagFactory::integrationWebpayNormal();

        $plus = TransbankServiceFactory::normal($bag);
        try{
            $response = $plus->getTransactionResult();
            //$payment = $this->Payments->find('all',['conditions' => ['request_id' => $response->buyOrder],'order' => ['created' => 'desc']])->first();
            $payment = $this->Payments->get($response->buyOrder);
            $payment->accoutingDate      = $response->accountingDate;
            $payment->transactionDate    = $response->transactionDate;
            $payment->VCI                = $response->VCI;
            $payment->cardNumber         = $response->cardDetail->cardNumber;
            $payment->cardExpirationDate = $response->cardDetail->cardExpirationDate;
            $payment->authorizationCode  = $response->detailOutput->authorizationCode;
            $payment->paymentTypeCode    = $response->detailOutput->paymentTypeCode;
            $payment->responseCode       = $response->detailOutput->responseCode;
            $payment->amount_tbk         = $response->detailOutput->amount;
            $payment->sharesNumber       = $response->detailOutput->sharesNumber;
            $payment->commerceCode       = $response->detailOutput->commerceCode;

            //request para poder actualizarlo
            $orden = $this->Payments->Requests->get($payment->request_id, [
                'contain' => []
            ]);

            if($response->detailOutput->responseCode == 0){
                $payment->paid = 1;

                if($orden['status'] == RequestStatus::EnEsperaraPagoMod){
                  $orden->status = RequestStatus::EnEsperaTrabajo;

                  //Se actualizan los servicios asociados de status 2 a status 1
                  $result = TableRegistry::get("RequestsMechanicMods")
                             ->query()
                             ->update()
                             ->set(['status' => ServicesModStatus::Pagado])
                             ->where(['request_id' => $orden->id,
                                      'status' => ServicesModStatus::Aprobada,
                                      'active' => 1])
                             ->execute();
                }
                else{
                  $orden->status = RequestStatus::Pagado;
                }
            } else {
                $payment->paid = 0;
                $orden->status = RequestStatus::PagoFallido;
            }

            $this->Payments->Requests->save($orden);
            $this->Payments->save($payment);
        } catch (\SoapFault $e) {
            //debug(json_encode($e)); die;
            $this->rejection($id,'3');
        }

        //If everything goes well (check stock, check amount, etc) you can call acknowledgeTransaction to accept the payment. Otherwise, the transaction is reverted in 30 seconds.
        //Si todo está bien, peudes llamar a acknowledgeTransaction. Si no se llama a este método, la transaccion se reversará en 30 segundos.

        $plus->acknowledgeTransaction();

        //Redirect back to Webpay Flow and then to the thanks page
        echo RedirectorHelper::redirectBackNormal($response->urlRedirection);
    }

    public function end($id = null)
    {
        $this->viewBuilder()->layout('ajax');

        //Aquí debe lanzar error de TIMEOUT (si entró a esta rama el usuario anuló la transacción)
        if (!empty($this->request->data['TBK_TOKEN'])) {
            try{
                LoggerFactory::setLogger(new TransbankCertificationLogger('/var/www/nginx-default/logs/transbank/'));
                $bag = CertificationBagFactory::integrationWebpayNormal();
                $plus = TransbankServiceFactory::normal($bag);
                //Aquí se lanza el error
                $response = $plus->getTransactionResult($this->request->data['TBK_TOKEN']);
                $orden = $this->Payments->findByToken($this->request->data['TBK_TOKEN'])->first();

            } catch (\SoapFault $e) {
                $orden = $this->Payments->findByToken($this->request->data['TBK_TOKEN'])->first();
                $id = $orden->id;
                if(empty($orden->responseCode)){
                    //De momento devolvemos todos los resultados como Json
                    // debug(json_encode($e)); die;
                    $this->rejection($id,'4');
                }else{

                }
            }
            $this->_send_mail($id);
        } else {
            $orden = $this->Payments->findByToken($this->request->data['token_ws'])->first();
            $id = $orden->id;
            $this->_send_mail($id);
        }

        $res = ['faultstring' => '','faultcode' => '','orderId' => $id,'responseCode' => $orden->responseCode];
        //debug('resultado correcto redireccionamos a la app');
        $this->redirect('http://localhost:3000/#/pages/solicitar-servicios/webpay-finish/'.$id);
        $this->autoRender = false;
    }

    public function _send_mail($id){
        $route_attachement= '';
        $payment = $this->Payments->get($id, [
            'contain' => ['Requests', 'Requests.Cars','Requests.AvailableServices','Requests.Clients', 'Requests.Cities','Requests.Communes','Requests.Mechanics'=> function($q){
                return $q->select([
                    'name',
                    'last_name',
                    'email',
                    'phone1',
                    ]);
            }]
        ]);

        if ($payment->responseCode == '0'){

            $brand_obj = TableRegistry::get("CarBrands")
                     ->find()
                     ->select(['CarBrands.brand_name'])
                     ->where(['id' => $payment->request->car['car_brand_id']])
                     ->first();

           $model_obj = TableRegistry::get("CarModels")
                    ->find()
                    ->select(['CarModels.model_name'])
                    ->where(['id' => $payment->request->car['car_model_id']])
                    ->first();


            $payment->car_brand_name= $brand_obj['brand_name'];
            $payment->car_model_name= $model_obj['model_name'];

            $main= new MainPaymentVoucherPdf();
            $file_name= 'Comprobante_Pago_'.date('dmYHis').'.pdf';
            $main->download($payment, 'Comprobante de Pago', $file_name , $payment->request->client);
            $route_attachement= WWW_ROOT .'files' . DS . 'temp'. DS .$file_name;

            //fin guardar documento pdf


                $this->loadModel('Invoices');
                $invoice = $this->Invoices->find('all',['conditions' => ['request_id' => $payment->request->id],'order' => ['id' => 'desc']])->first();
                $datos_factura = "";
                if(!empty($invoice->full_name)){
                    $datos_factura .= "<br>";
                    $datos_factura .= "<br>------------------------------";
                    $datos_factura .= "<br><b>DATOS DE LA FACTURA</b>";
                    $datos_factura .= "<br><b>Nombre:</b> ".$invoice->full_name;
                    $datos_factura .= "<br><b>Dirección:</b> ".$invoice->address;
                    $datos_factura .= "<br><b>RUT:</b> ".$invoice->rut;
                    $datos_factura .= "<br><b>Giro:</b> ".$invoice->giro;
                    $datos_factura .= "<br>";
                }

                $ii = [];
                foreach ($payment->request->available_services as $value) {
                    $ii[] = $value->name;
                }

                $resumen_pedido = implode("<br>", $ii);

                    $contenido   = "";
                    $contenido .= "<h3>**** RESUMEN DEL PROCESO DE PAGO ****</h3>";
                    $contenido .= "<br><b>Orden de compra</b>: ".$id;
                    $contenido .= "<br><b>Nombre de comercio:</b> FullMec SPA";
                    $contenido .= "<br><b>Monto:</b> ".$this->_get_tb_monto($payment->amount_tbk);
                    $contenido .= "<br><b>Codigo de autorizacion:</b> ".$payment->authorizationCode;
                    $contenido .= "<br><b>Fecha:</b> ".$payment->transactionDate;
                    $contenido .= "<br><b>Tipo de pago:</b> ".$this->_get_tb_tipo_pago($payment->paymentTypeCode);
                    $contenido .= "<br><b>Tipo de cuotas:</b> ".$this->_get_tb_tipo_cuotas($payment->paymentTypeCode);
                    $contenido .= "<br><b>Cantidad de cuotas:</b> ".$payment->sharesNumber;
                    $contenido .= "<br><b>Numero de tarjeta:</b> ********".$payment->cardNumber;
                    $contenido .= "<br><b>Descripcion de bienes y servicios:</b>";
                    $contenido .= "<br>".$resumen_pedido;
                    $contenido .= "<br>".$datos_factura;


        }else{
            $contenido  = "";
            $contenido .= "<h3>**** RESUMEN DEL PROCESO DE PAGO ****</h3>";
            $contenido .= "<br>";
            $contenido .= "<br><b>Orden de compra:</b> ".$id;
            $contenido .= "<br>";
            $contenido .= "<br><b>Posibles causas de este rechazo son:</b>";
            $contenido .= "<br>    - Error en el ingreso de los datos de su tarjeta de Credito o Debito (fecha y/o codigo de seguridad).";
            $contenido .= "<br>    - Su tarjeta de Credito o Debito no cuenta con saldo suficiente.";
            $contenido .= "<br>    - Tarjeta aún no habilitada en el sistema financiero.";
            $contenido .= "<br>";
    }

    $titulo = 'Detalles del pago de la orden '.$id;

    if(isset($contenido)){
        $data = [
            'title'=>$titulo,
            'to'=>$payment->request->client->email,
            'body'=>  $contenido,
            'subject'=> $titulo
        ];

        if($route_attachement !== ''){
          $data['attachments'] = $route_attachement;
        }

        $this->Message->send($data);
    }

  }//end _send_mail


    public function _get_tb_autorizacion($code){
        $retorno = '';
        if ($code == '0')
            $retorno = 'Transaccion aprobada';
        else if ($code == '-1')
            $retorno = 'Rechazo de transaccion';
        else if ($code == '-2')
            $retorno = 'Transaccion debe reintentarse';
        else if ($code == '-3')
            $retorno = 'Error en transaccion';
        else if ($code == '-4')
            $retorno = 'Rechazo de transaccion';
        else if ($code == '-5')
            $retorno = 'Rechazo por error de tasa';
        else if ($code == '-6')
            $retorno = 'Excede cupo maximo mensual';
        else if ($code == '-7')
            $retorno = 'Excede limite diario por transaccion';
        else
            $retorno = 'Rubro no autorizado';

        return $retorno;
    }

    public function _get_tb_tipo_pago($code){
        $retorno = '';
        if ($code == 'VD')
            $retorno = 'Debito';
        else
            $retorno = 'Credito';

        return $retorno;
    }

    public function _get_tb_tipo_cuotas($code){
        $retorno = '';
        if ($code == 'VD')
            $retorno = 'Venta Debito';
        else if ($code == 'VN')
            $retorno = 'Sin cuotas';
        else if ($code == 'VC')
            $retorno = 'Cuotas normales';
        else if ($code == 'SI')
            $retorno = 'Sin interes';
        else if ($code == 'S2')
            $retorno = 'Sin interes';
        else
            $retorno = 'Sin interes';

        return $retorno;
    }

    public function _get_tb_monto($monto){
        return '$ '.($monto);
    }

}
