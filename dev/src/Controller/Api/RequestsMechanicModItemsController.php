<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

/**
 * RequestsMechanicModItems Controller
 *
 * @property \App\Model\Table\RequestsMechanicModItemsTable $RequestsMechanicModItems
 */
class RequestsMechanicModItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests', 'RequestsMechanicMods']
        ];
        $requestsMechanicModItems = $this->paginate($this->RequestsMechanicModItems);

        $this->set(compact('requestsMechanicModItems'));
        $this->set('_serialize', ['requestsMechanicModItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Requests Mechanic Mod Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestsMechanicModItem = $this->RequestsMechanicModItems->get($id, [
            'contain' => ['Requests', 'RequestsMechanicMods']
        ]);

        $this->set('requestsMechanicModItem', $requestsMechanicModItem);
        $this->set('_serialize', ['requestsMechanicModItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestsMechanicModItem = $this->RequestsMechanicModItems->newEntity();
        if ($this->request->is('post')) {
            $requestsMechanicModItem = $this->RequestsMechanicModItems->patchEntity($requestsMechanicModItem, $this->request->data);
            if ($this->RequestsMechanicModItems->save($requestsMechanicModItem)) {
                $this->Flash->success(__('The requests mechanic mod item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests mechanic mod item could not be saved. Please, try again.'));
        }
        $requests = $this->RequestsMechanicModItems->Requests->find('list', ['limit' => 200]);
        $requestsMechanicMods = $this->RequestsMechanicModItems->RequestsMechanicMods->find('list', ['limit' => 200]);
        $this->set(compact('requestsMechanicModItem', 'requests', 'requestsMechanicMods'));
        $this->set('_serialize', ['requestsMechanicModItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Requests Mechanic Mod Item id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestsMechanicModItem = $this->RequestsMechanicModItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestsMechanicModItem = $this->RequestsMechanicModItems->patchEntity($requestsMechanicModItem, $this->request->data);
            if ($this->RequestsMechanicModItems->save($requestsMechanicModItem)) {
                $this->Flash->success(__('The requests mechanic mod item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests mechanic mod item could not be saved. Please, try again.'));
        }
        $requests = $this->RequestsMechanicModItems->Requests->find('list', ['limit' => 200]);
        $requestsMechanicMods = $this->RequestsMechanicModItems->RequestsMechanicMods->find('list', ['limit' => 200]);
        $this->set(compact('requestsMechanicModItem', 'requests', 'requestsMechanicMods'));
        $this->set('_serialize', ['requestsMechanicModItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Requests Mechanic Mod Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestsMechanicModItem = $this->RequestsMechanicModItems->get($id);
        if ($this->RequestsMechanicModItems->delete($requestsMechanicModItem)) {
            $this->Flash->success(__('The requests mechanic mod item has been deleted.'));
        } else {
            $this->Flash->error(__('The requests mechanic mod item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
