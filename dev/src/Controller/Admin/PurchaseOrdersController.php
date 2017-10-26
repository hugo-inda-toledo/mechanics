<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\Email;

/**
 * PurchaseOrders Controller
 *
 * @property \App\Model\Table\PurchaseOrdersTable $PurchaseOrders
 */
class PurchaseOrdersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Message');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests']
        ];
        $purchaseOrders = $this->paginate($this->PurchaseOrders);

        $this->set(compact('purchaseOrders'));
        $this->set('_serialize', ['purchaseOrders']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('PurchaseOrdersReplacements');
        $this->loadModel('PurchaseOrdersSupplies');
        $this->loadModel('Replacements');
        $this->loadModel('Providers');
        $this->loadModel('Supplies');

        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['Requests' => ['AvailableServices' => ['RequestsTypes'], 'Mechanics', 'Clients','Cars' => ['CarBrands', 'CarModels'], 'Cities', 'Communes']]
        ]);

        $purchaseOrderReplacements = $this->PurchaseOrdersReplacements->find('all')
            ->contain(['Replacements', 'Providers'])
            ->where(['PurchaseOrdersReplacements.purchase_order_id' => $id])
            ->toArray();
        
        $purchaseOrderSupplies = $this->PurchaseOrdersSupplies->find('all')
            ->contain(['Supplies', 'Providers'])
            ->where(['PurchaseOrdersSupplies.purchase_order_id' => $id])
            ->toArray();


        if(is_null($purchaseOrder->active))
        {
            $this->set('replacements', $this->Replacements->find('list', ['order' => ['Replacements.name' => 'ASC']]));
            $this->set('supplies', $this->Supplies->find('list', ['order' => ['Supplies.name' => 'ASC']]));
            $this->set('providers', $this->Providers->find('list', ['order' => ['Providers.name' => 'ASC']]));
        }

        $this->set('purchaseOrderReplacements', $purchaseOrderReplacements);
        $this->set('purchaseOrderSupplies', $purchaseOrderSupplies);

        $this->set('purchaseOrder', $purchaseOrder);
        $this->set('_serialize', ['purchaseOrder']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($request_id = null)
    {
        if($request_id != null)
        {
            $purchaseOrder = $this->PurchaseOrders->newEntity();
            if ($this->request->is('post')) {
                $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->data);
                if ($this->PurchaseOrders->save($purchaseOrder)) {
                    $this->Flash->success(__('The purchase order has been saved.'));

                    return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
                }
                $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
            }

            $request = $this->PurchaseOrders->Requests->find('all', ['contain' => ['AvailableServices', 'PurchaseOrders'], 'conditions' => ['Requests.id' => $request_id]])->first();

            if($request->status == 2 || $request->status == 5)
            {
                $this->Flash->error(__('No es posible crear ordenes de compra cuando la solicitud esta en curso o finalizada.'));
                return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
            }

            if(count($request->purchase_orders) > 0)
            {
                $ids = array();

                foreach($request->purchase_orders as $purchase_order)
                {
                    foreach($purchase_order->items as $item)
                    {
                        $ids[] = $item->id;
                    }
                }

                $items = $this->PurchaseOrders->Items->find('list', ['conditions' => ['Items.id NOT IN' => $ids]]);
            }
            else
            {
                //$items = $this->PurchaseOrders->Items->find('list', ['limit' => 200]);
            }
            
            $this->set(compact('purchaseOrder', 'request', 'items'));
            $this->set('_serialize', ['purchaseOrder']);
        }
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrder = $this->PurchaseOrders->get($id, [
            'contain' => ['Items']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrder = $this->PurchaseOrders->patchEntity($purchaseOrder, $this->request->data);
            if ($this->PurchaseOrders->save($purchaseOrder)) {
                $this->Flash->success(__('The purchase order has been saved.'));

                return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
            }
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }

        $request = $this->PurchaseOrders->Requests->find('all', ['contain' => ['AvailableServices', 'PurchaseOrders' => ['Items']], 'conditions' => ['Requests.id' => $purchaseOrder->request_id]])->first();

        if($request->status == 2 || $request->status == 5)
        {
            $this->Flash->success(__('No es posible crear ordenes de compra cuando la solicitud esta en curso o finalizada.'));
            return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
        }

        if(count($request->purchase_orders) > 0)
        {
            $ids = array();

            foreach($request->purchase_orders as $purchase_order)
            {
                if($purchase_order->id != $purchaseOrder->id)
                {
                    foreach($purchase_order->items as $item)
                    {
                        $ids[] = $item->id;
                    }
                }
            }

            if($ids != null)
            {
                $items = $this->PurchaseOrders->Items->find('list', ['conditions' => ['Items.id NOT IN' => $ids]]);
            }
            else
            {
                $items = $this->PurchaseOrders->Items->find('list', ['limit' => 200]);
            }
        }
        else
        {
            $items = $this->PurchaseOrders->Items->find('list', ['limit' => 200]);
        }

        $this->set(compact('purchaseOrder', 'request', 'items'));
        $this->set('_serialize', ['purchaseOrder']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Order id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrder = $this->PurchaseOrders->get($id);
        if ($this->PurchaseOrders->delete($purchaseOrder)) {
            $this->Flash->success(__('The purchase order has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
    }

    public function approve($id = null)
    {
        if($id != null)
        {
            $purchase_order = $this->PurchaseOrders->get($id);
            $purchase_order->active = 1;
            
            if($this->PurchaseOrders->save($purchase_order))
            {
                //$this->_send_mail_confirm_purchase_order($purchase_order);

                $this->Flash->success(__('The purchase order has been accepted.'));
                return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
            }
        }
    }

    public function reject($id = null)
    {
        if($id != null)
        {
            $purchase_order = $this->PurchaseOrders->get($id);
            $purchase_order->active = 0;
            $this->PurchaseOrders->save($purchase_order);

            if($this->PurchaseOrders->save($purchase_order))
            {
                $this->Flash->success(__('The purchase order has been rejected.'));
                return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
            }
        }
    }

    public function _send_mail_confirm_purchase_order($purchase_order)
    {
        $email = new Email('default');

        $this->loadModel('Users');
        $user  = $this->Users->get(2);

        $titulo = 'Estimado '.$user->name . ' ' . $user->last_name;
        
        $contenido_correo =
            'Saludos <b>' . $user->name . ' ' . $user->last_name . ',</b><br>' .
            '<br>' .
            'El sistema te informa que se ha generado y aceptado una nueva orden de compra de productos.<br>' .
            'A continuacion se muestra un listado de los productos asociados.'.
            '<br>'.
            '<ul>';

        foreach($purchase_order->items as $item)
        {
            $contenido_correo .= '<li>'.$item->name.'</li>';
        }

        $contenido_correo .= '</ul>';

        if(isset($contenido_correo))
        {
            $data = [
                'title' => $titulo,
                'to' => $user->email,
                'body' => $contenido_correo,
                'subject' => $titulo
            ];

            $this->Message->send($data);
        }
    }

    function ordersSearch()
    {

    }

    function ordersResult()
    {
        if($this->request->is('post'))
        {
            $dates = explode('-', $this->request->data['range']);

            $month = $dates[0];
            $year = $dates[1];

            $purchase_orders = $this->PurchaseOrders->find('all')
                                ->contain([
                                    'Requests',
                                    'Items' => [
                                        'Providers',
                                        'Categories'
                                    ]
                                ])
                                ->where([
                                    'MONTH(PurchaseOrders.created)' => $month,
                                    'YEAR(PurchaseOrders.created)' => $year
                                ])
                                ->order([
                                    'PurchaseOrders.created' => 'DESC'
                                ])
                                ->toArray();

            if(count($purchase_orders) > 0)
            {
                $this->set('purchase_orders', $purchase_orders);
                $this->set('year', $year);
                $this->set('month', $month);
            }
            else
            {
                $this->Flash->error(__('No existen ordenes de compra para el mes/año seleccionado'));
                $this->redirect(['action' => 'ordersSearch']);
            }

            /*echo '<pre>';
            print_r($purchase_orders);
            echo '</pre>';*/
        }
    }

    function ordersResultExport()
    {
        if($this->request->is('post'))
        {
            $purchase_orders = $this->PurchaseOrders->find('all')
                                ->contain([
                                    'Requests',
                                    'Items' => [
                                        'Providers',
                                        'Categories'
                                    ]
                                ])
                                ->where([
                                    'MONTH(PurchaseOrders.created)' => $this->request->data['month'],
                                    'YEAR(PurchaseOrders.created)' => $this->request->data['year']
                                ])
                                ->order([
                                    'PurchaseOrders.created' => 'DESC'
                                ])
                                ->toArray();

            foreach($purchase_orders as $purchase_order)
            {
                foreach($purchase_order->items as $item)
                {
                    $provider_name = '';

                    foreach($item->providers as $provider)
                    {
                        if($provider->id == $item->_joinData->provider_id)
                        {
                            $provider_name = $provider->name;
                            break;
                        }
                    }

                    $purchase_orders_month[] = array(
                        'ID Orden de Compra' => $purchase_order->id,
                        'Categoría' => $item->category->name,
                        'Insumo' => $item->name,
                        'Marca' => $item->brand,
                        'Proveedor' => $provider_name,
                        'Valor Insumo' => $item->cost,
                    );
                }
            }

            $this->set('purchase_orders', $purchase_orders_month);
        }
    }
}
