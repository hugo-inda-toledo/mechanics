<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Tools Controller
 *
 * @property \App\Model\Table\ToolsTable $Tools
 */
class ToolsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $tools = $this->paginate($this->Tools);

        $this->set(compact('tools'));
        $this->set('_serialize', ['tools']);
    }

    /**
     * View method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tool = $this->Tools->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('tool', $tool);
        $this->set('_serialize', ['tool']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tool = $this->Tools->newEntity();
        if ($this->request->is('post')) {
            $tool = $this->Tools->patchEntity($tool, $this->request->data);
            if ($this->Tools->save($tool)) {
                $this->Flash->success(__('The tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tool could not be saved. Please, try again.'));
        }
        $users = $this->Tools->Users->find('list', ['limit' => 200]);
        $this->set(compact('tool', 'users'));
        $this->set('_serialize', ['tool']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tool = $this->Tools->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tool = $this->Tools->patchEntity($tool, $this->request->data);
            if ($this->Tools->save($tool)) {
                $this->Flash->success(__('The tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tool could not be saved. Please, try again.'));
        }
        $users = $this->Tools->Users->find('list', ['limit' => 200]);
        $this->set(compact('tool', 'users'));
        $this->set('_serialize', ['tool']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tool id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tool = $this->Tools->get($id);
        if ($this->Tools->delete($tool)) {
            $this->Flash->success(__('The tool has been deleted.'));
        } else {
            $this->Flash->error(__('The tool could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
