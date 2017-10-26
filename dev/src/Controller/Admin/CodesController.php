<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Codes Controller
 *
 * @property \App\Model\Table\CodesTable $Codes
 */
class CodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $codes = $this->paginate($this->Codes);

        $this->set(compact('codes'));
        $this->set('_serialize', ['codes']);
    }

    /**
     * View method
     *
     * @param string|null $id Code id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $code = $this->Codes->get($id, [
            'contain' => ['Banks']
        ]);

        $this->set('code', $code);
        $this->set('_serialize', ['code']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $code = $this->Codes->newEntity();
        if ($this->request->is('post')) {
            $code = $this->Codes->patchEntity($code, $this->request->data);
            if ($this->Codes->save($code)) {
                $this->Flash->success(__('The {0} has been saved.', 'Code'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Code'));
            }
        }
        $banks = $this->Codes->Banks->find('list', ['limit' => 200]);
        $this->set(compact('code', 'banks'));
        $this->set('_serialize', ['code']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Code id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $code = $this->Codes->get($id, [
            'contain' => ['Banks']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $code = $this->Codes->patchEntity($code, $this->request->data);
            if ($this->Codes->save($code)) {
                $this->Flash->success(__('The {0} has been saved.', 'Code'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Code'));
            }
        }
        $banks = $this->Codes->Banks->find('list', ['limit' => 200]);
        $this->set(compact('code', 'banks'));
        $this->set('_serialize', ['code']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Code id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $code = $this->Codes->get($id);
        if ($this->Codes->delete($code)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Code'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Code'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
