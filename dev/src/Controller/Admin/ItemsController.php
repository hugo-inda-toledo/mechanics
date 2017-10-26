<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Ideauno\RequestStatus;
use Cake\ORM\TableRegistry;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index']
        ]);
        $this->loadComponent('Message');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
 		$query = $this->Items
        ->find('search', ['search' => $this->request->query])
        ->contain(['Providers','AvailableServices','Categories']);

        $this->set('items', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['AvailableServices', 'Providers', 'ItemsLogs', 'PurcharseOrderItems']
        ]);

        $this->set('item', $item);
        $this->set('_serialize', ['item']);
    }


    public function desactivated($id){
        $item = $this->Items->get($id);
        $item->active = !$item->active;
        if($this->Items->save($item)){
                $this->Flash->success(__('El item fué actualizado'));
        }
        else{
            $this->Flash->error(__('El item no se pudo actualizar'));
        }
        return $this->redirect(['action' => 'index']);
    }


    // test calculator!
    public function test(){

         $this->autoRender = false;
         //$this->loadComponent('Calculator');

        //$data = ['to'=>['pablo.rodriguez@ideauno.cl','nicolas.veral@gmail.com','gabriel.rebolledo@ideauno.cl'],'title'=>'probando cambios plantilla correo','subject'=>'test correo','alias'=>'mensaje lala'];
        $data = ['to'=>['nicolas.veral@gmail.com'],'title'=>'probando cambios plantilla correo','subject'=>'test correo','alias'=>'mensaje lala'];
        $this->Message->send($data);

         //$data = $this->Calculator->calculate([2]);

         //debug(RequestStatus::EnCurso);

        //  debug(RequestStatus::toString(1));
        //  debug(RequestStatus::toString(2));
        //  debug(RequestStatus::toString(3));
        //  debug(RequestStatus::toString(4));
        //  debug(RequestStatus::toString(5));

    }


    /**
    * HU2.20 Importar archivo de costos en formato excel
    */
    public function importFile(){

    }

    function exportData()
    {

    }

    /**
    * HU2.21 Exportar  archivo de costos en formato excel
    */
    public function exportFile()
    {
        if($this->request->is('post'))
        {
            $dates = explode(' - ', $this->request->data['range']);

            $start_date = $dates[0];
            $end_date = $dates[1];

            $items = $this->Items->find('all')
                    ->contain(['Categories'])
                    ->where(function ($exp, $q) use($start_date,$end_date) {
                         return $exp->between('Items.created', $start_date, $end_date);
                     })
                    ->toArray();

            if(count($items) > 0)
            {
                foreach($items as $item)
                {
                    $item->category_id = $item->category->name;
                }

                $this->set('items', $items);
            }
            else
            {
                $this->Flash->error(__('No existen insumos entre las fechas seleccionadas'));
                $this->redirect(['controller' => 'Items', 'action' => 'exportData']);
            }
        }

    }

    public function addToPurchaseOrder($purchase_order_id = null)
    {
        if($purchase_order_id != null)
        {
            if ($this->request->is(['patch', 'post', 'put'])) {

                if($this->request->data['PurchaseOrdersItems']['item_id'] != null)
                {
                    foreach($this->request->data['PurchaseOrdersItems']['item_id'] as $key => $value)
                    {
                        $new[] = array('purchase_order_id' => $this->request->data['purchase_order_id'], 'item_id' => $value);
                    }

                    $purchase_orders_items = TableRegistry::get('PurchaseOrdersItems');
                    $entities = $purchase_orders_items->newEntities($new);
                    $purchase_orders_items->saveMany($entities);

                    return $this->redirect(['controller' => 'Requests', 'action' => 'index']);
                    $this->Flash->success(__('Items agregados a la orden de compra.'));
                }

                $this->Flash->error(__('Debes seleccionar al menos 1 item'));

            }

            $this->loadModel('Categories');
            $categories = $this->Categories->find('all')
                        ->contain([
                          'Items' => function ($q){
                            return $q->order(['Items.name' => 'ASC']);
                          }

                        ])
                        ->order(['Categories.name' => 'ASC'])
                        ->toArray();

            $items_list = array();
            foreach($categories as $category)
            {
                foreach($category->items as $item)
                {
                    $items_list[$category->name][$item->id] = $item->name;
                }
            }

            $this->loadModel('PurchaseOrders');
            $purchase_order = $this->PurchaseOrders->get($purchase_order_id, ['contain' => ['Requests' => ['AvailableServices']]]);
            $this->set('purchase_order', $purchase_order);
            $this->set('items_list', $items_list);
        }
    }

    public function stockList()
    {
        $this->set('items', $this->Items->find('all')->contain(['Categories'])->where(['Items.active' => 1])->toArray());
    }
}
