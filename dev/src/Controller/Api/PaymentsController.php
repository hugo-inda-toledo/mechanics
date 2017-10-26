<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Firebase\JWT\JWT;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;

class PaymentsController extends AppController
{
    public $id_local = null;
    public $id_user = null;
    public $id_request = null;

    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['webpay']);
    }//end initialize

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Crud->disable(['delete','edit','index','add']);
    }//end beforeFilter

    public function view($id = null ){
        $user = $this->Auth->identify();
        $this->id_local = $id;
        $this->id_user = $user['id'];
        $this->Crud->on('beforeFind', function(Event $event) {
             $event->subject()
                ->query
                ->where(['Payments.id' => $this->id_local])
                ->contain(['Requests'])
                ->contain(['Requests.AvailableServices'])
                ->contain(['Requests.Invoices']);
        });

        return $this->Crud->execute();
    }//end view

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

}//end Payments
