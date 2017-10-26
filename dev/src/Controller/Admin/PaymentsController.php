<?php
namespace App\Controller\Admin;
use Ideauno\RequestStatus;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PaymentMethods', 'Requests']
        ];
        $payments = $this->paginate($this->Payments);

        $this->set(compact('payments'));
        $this->set('_serialize', ['payments']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['PaymentMethods', 'Requests']
        ]);

        $this->set('payment', $payment);
        $this->set('_serialize', ['payment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($request_id = null)
    {

        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->data);
            if ($this->Payments->save($payment)) {

                $this->loadModel('Requests');
                $request = $this->Requests->get($request_id);
                $request->status = RequestStatus::EnEsperaPago;

                if($this->Requests->save($request))
                {
                    $this->Flash->success(__('The payment has been saved.'));
                }

                return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $paymentMethods = $this->Payments->PaymentMethods->find('list', ['limit' => 200]);
        $request = $this->Payments->Requests->find('all', ['contain' => ['Clients', 'AvailableServices', 'Mechanics'], 'conditions' => ['Requests.id' => $request_id]])->first();

        /*echo '<pre>';
        print_r($request->toArray());
        echo '</pre>';*/
        $this->set(compact('payment', 'paymentMethods', 'request'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->data);
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $paymentMethods = $this->Payments->PaymentMethods->find('list', ['limit' => 200]);
        $requests = $this->Payments->Requests->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'paymentMethods', 'requests'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    function markAsPaid($payment_id = null)
    {
        if($payment_id != null)
        {
            $payment = $this->Payments->get($payment_id);
            $payment->paid = 1;
            $payment->paid_mechanic = 0;
            $payment->paid_provider = 0;
            $payment->active = 1;
            $this->Payments->save($payment);

            $this->loadModel('Requests');
            $request = $this->Requests->find('all')->contain(['Cars' => ['CarBrands'], 'AvailableServices' => ['Supplies' => ['Providers'], 'Replacements' => ['CarBrands' =>['Providers']]]])->where(['Requests.id' => $payment->request_id])->first();
            
            //Si es que ya tenia un mecanico asignado significa que son modificaciones que fueron agregadas por este, no es necesario asignar nuevo mecanico.
            if($request->mechanic_id)
            {
                $request->status = RequestStatus::EnEsperaTrabajo;

                //Se actualizan los servicios asociados de status 2 a status 1
                $tablename = TableRegistry::get("RequestsAvailableServices");
                $query =$tablename->query();
                $result= $query->update()
                             ->set(['active' => 1])
                             ->where(['request_id' => $payment->request_id])
                             ->execute();
            }
            else
            {
                $request->status = RequestStatus::Pagado;
            }

            $request->ot_code = $request->id;
            $this->Requests->save($request);



            /*echo '<pre>';
            print_r($request);
            echo '</pre>';

            die();*/

            $purchaseOrdersTable = TableRegistry::get('PurchaseOrders');
            $purchase_order = $purchaseOrdersTable->newEntity();
            $purchase_order->request_id = $request->id;
            $purchase_order->active = null;
            $purchaseOrdersTable->save($purchase_order);

            $new_replacements = array();
            $new_supplies = array();

            if(count($request->available_services) > 0)
            {
                foreach($request->available_services as $available_service)
                {
                    if(count($available_service->replacements) > 0)
                    {
                        foreach($available_service->replacements as $replacement)
                        {

                            if(count($replacement->car_brands) > 0)
                            {

                                foreach($replacement->car_brands as $car_brand)
                                {
                                    if($car_brand->_joinData->stock == 0)
                                    {
                                        if($car_brand->id == $request->car->car_brand_id)
                                        {
                                            $provider_id = '';

                                            if(count($car_brand->providers) > 0)
                                            {
                                                foreach($car_brand->providers as $provider)
                                                {
                                                    if($provider->_joinData->default_provider == 1)
                                                    {
                                                        $provider_id = $provider->id;
                                                        break;
                                                    }
                                                }
                                            }



                                            $new_replacements[] = array('purchase_order_id' => $purchase_order->id, 'replacement_id' => $replacement->id, 'provider_id' => $provider_id);
                                        }
                                    }
                                }
                            }
                        }

                        if($new_replacements != null)
                        {
                            $purchase_orders_replacements = TableRegistry::get('PurchaseOrdersReplacements');
                            $entities = $purchase_orders_replacements->newEntities($new_replacements);
                            $purchase_orders_replacements->saveMany($entities);
                        }
                    }

                    if(count($available_service->supplies) > 0)
                    {
                        foreach($available_service->supplies as $supply)
                        {
                            if($supply->stock == 0)
                            {
                                if(count($supply->providers) > 0)
                                {
                                    $provider_id = '';
                                    foreach($supply->providers as $provider)
                                    {
                                        if($provider->_joinData->default == 1)
                                        {
                                            $provider_id = $provider->_joinData->provider_id;
                                            break;
                                        }
                                    }

                                    $new_supplies[] = array('purchase_order_id' => $purchase_order->id, 'supply_id' => $supply->id, 'provider_id' => $provider_id);
                                }
                            }
                        }

                        if($new_supplies != null)
                        {
                            $purchase_orders_supplies = TableRegistry::get('PurchaseOrdersSupplies');
                            $entities = $purchase_orders_supplies->newEntities($new_supplies);
                            $purchase_orders_supplies->saveMany($entities);
                        }
                    }
                }
            }

            if($new_supplies == null && $new_replacements == null)
            {
                $this->loadModel('PurchaseOrders');
                $entity = $this->PurchaseOrders->get($purchase_order->id);
                $result = $this->PurchaseOrders->delete($entity);
            }

            if($request->mechanic_id == null)
            {
                $this->loadModel('Users');
                if($this->Users->searchMechanics($request->id))
                {
                    $this->Flash->success(__('Hemos contactados a los 5 mecánicos mas cercanos, mantente alerta'));
                }
            }
            else
            {
                $this->Flash->success(__('Se ha generado una orden de trabajo.'));
            }

            return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
        }
    }

    public function exportData()
    {

    }

    /**
    * HU2.22 Exportar archivos de pagos mecánicos
    */
    public function exportPaymentsMechanics()
    {
        if($this->request->is('post'))
        {
            $dates = explode('-', $this->request->data['range']);

            $month = $dates[0];
            $year = $dates[1];

            $payments = $this->Payments->find('all')
                    ->contain([
                        'Requests' => [
                            'Mechanics' => [
                                'PaymentRefunds' => [
                                    'Banks' =>[
                                        'Codes'
                                    ]
                                ]
                            ]
                        ]
                    ])
                    ->where([
                        'Payments.paid' => 1,
                        'Payments.paid_mechanic' => 0,
                        'MONTH(Payments.created)' => $month,
                        'YEAR(Payments.created)' => $year
                    ])
                    ->toArray();

            if(count($payments) > 0)
            {
                $pending_payments = array();

                foreach($payments as $payment)
                {

                    $mechanic_name = '';
                    $mechanic_dni = '';
                    $mechanic_email = '';
                    $mechanic_account = '';

                    if(count($payment->request->mechanic->payment_refunds) > 0)
                    {
                        foreach($payment->request->mechanic->payment_refunds as $payment_refund)
                        {
                            if($payment->request->mechanic->id == $payment_refund->_joinData->user_id && $payment_refund->_joinData->default == 1)
                            {
                                $mechanic_name = $payment_refund->name;
                                $mechanic_dni = $payment_refund->dni;
                                $mechanic_email = $payment_refund->email;
                                $mechanic_account = $payment_refund->account_number;

                                if(count($payment_refund->bank->codes) > 0)
                                {

                                    foreach($payment_refund->bank->codes as $code)
                                    {
                                        if($code->_joinData->bank_id == $payment_refund->bank->id)
                                        {
                                            $code_number = $code->code;
                                            break;
                                        }
                                    }
                                }

                                break;
                            }
                        }
                    }

                    $pending_payments[] = array(
                        'Cuenta Origen' => '02536512545',
                        'Moneda Cuenta Origen' => 'CLP',
                        'Cuenta Destino' => $mechanic_account,
                        'Moneda Cuenta Destino' => 'CLP',
                        'Codigo Banco' => $code_number,
                        'Rut Beneficiario' => $mechanic_dni,
                        'Nombre Beneficiario' => $mechanic_name,
                        'Monto Transferencia' => $payment->amount_mechanic.',00',
                        'Glosa Transferencia' => 'Pago de OT ['.$payment->request->ot_code.']',
                        'Dirección Correo Beneficiario' => $mechanic_email,
                        'Glosa Correo Beneficiario' => 'Pago de trabajos Fullmec',
                        'Glosa Cartola Cliente' => 'Pago de trabajos',
                        'Glosa Cartola Beneficiario' => 'Pago de trabajos',
                    );
                }

                $this->set('payments', $pending_payments);
            }
            else
            {
                $this->Flash->error(__('No existen pagos a mecánicos pendientes entre las fechas seleccionadas'));
                $this->redirect(['controller' => 'Payments', 'action' => 'exportData']);
            }
        }


    }

    public function salaryPaidSearch()
    {

    }

    public function salaryPaidResult()
    {
        if($this->request->is('post'))
        {
            $dates = explode('-', $this->request->data['range']);

            $month = $dates[0];
            $year = $dates[1];

            $payments = $this->Payments->find('all')
                    ->contain([
                        'Requests' => [
                            'Mechanics',
                            'Clients',
                            'Cars' => [
                              'CarBrands',
                              'CarModels'
                            ],
                            'Cities',
                            'Communes',
                            'AvailableServices'
                        ],
                        'PaymentMethods'
                    ])
                    ->where([
                        'Payments.paid' => 1,
                        'Payments.paid_mechanic' => 1,
                        'MONTH(Payments.created)' => $month,
                        'YEAR(Payments.created)' => $year
                    ])
                    ->toArray();

            if(count($payments) > 0)
            {
              $this->set('done_payments', $payments);
              $this->set('year', $year);
              $this->set('month', $month);
            }
            else
            {
                $this->Flash->error(__('No existen pagos para el mes/año seleccionado'));
                $this->redirect(['action' => 'salaryPaidSearch']);
            }
        }
    }

    public function salaryPaidResultExport()
    {
        if($this->request->is('post'))
        {
            $payments = $this->Payments->find('all')
                    ->contain([
                        'Requests' => [
                            'Mechanics',
                            'Clients',
                            'Cars' => [
                              'CarBrands',
                              'CarModels'
                            ],
                            'Cities',
                            'Communes',
                            'AvailableServices'
                        ],
                        'PaymentMethods'
                    ])
                    ->where([
                        'Payments.paid' => 1,
                        'Payments.paid_mechanic' => 1,
                        'MONTH(Payments.created)' => $this->request->data['month'],
                        'YEAR(Payments.created)' => $this->request->data['year']
                    ])
                    ->toArray();

            if(count($payments) > 0)
            {
                foreach($payments as $payment)
                {
                    $services_text = '';
                    foreach($payment->request->available_services as $service)
                    {
                        $services_text .= $service->name.', ';
                    }

                    $services_text = substr($services_text, 0, -2);

                    $done_payments[] = array(
                        'Orden de trabajo' => $payment->request->ot_code,
                        'Auto' => '('.$payment->request->car->year.') '.$payment->request->car->car_brand->brand_name.' '.$payment->request->car->car_model->model_name.' ['.$payment->request->car->patent.']',
                        'Cliente' => $payment->request->client->name.' '.$payment->request->client->last_name,
                        'Mecánico' => $payment->request->mechanic->name.' '.$payment->request->mechanic->last_name,
                        'Servicios a Realizar' => $services_text,
                        'Pago Total' => $payment->amount,
                        'Pago Mecánico' => $payment->amount_mechanic,
                    );
                }

                $this->set('payments', $done_payments);
            }
        }
    }

    /**
    * HU2.23 Exportar archivos de pagos proveedores
    */
    public function exportPaymentsProviders(){

    }

    /**
    * HU2.2.25. Módulo facturación
    * 1) Al finalizar un trabajo el sistema debe emitir un "comprobante de pago" en proforma que se envíe automáticamente al correo del cliente.
    * 2) Al final de cada día, se debe generar un archivo masivo de todas las proformas del día y enviarse al encargado de contabilidad de Fullmec
    * para que manualmente emita las boletas/facturas correspondientes.
    * 3) Finalmente el encargado debe cargar masivamente las boletas/facturas las cuales quedarán disponibles para cada cliente.
    */

    private function sendEmailPaymentToClient(){

    }

    private function sendEmailPaymentsToAdmin(){

    }
}
