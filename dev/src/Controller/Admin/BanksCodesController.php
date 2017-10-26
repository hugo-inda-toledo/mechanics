<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * BanksCodes Controller
 *
 * @property \App\Model\Table\BanksCodesTable $BanksCodes
 */
class BanksCodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Banks', 'Codes']
        ];
        $banksCodes = $this->paginate($this->BanksCodes);

        $this->set(compact('banksCodes'));
        $this->set('_serialize', ['banksCodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Banks Code id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $banksCode = $this->BanksCodes->get($id, [
            'contain' => ['Banks', 'Codes']
        ]);

        $this->set('banksCode', $banksCode);
        $this->set('_serialize', ['banksCode']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $banksCode = $this->BanksCodes->newEntity();
        if ($this->request->is('post')) {
            $banksCode = $this->BanksCodes->patchEntity($banksCode, $this->request->data);
            if ($this->BanksCodes->save($banksCode)) {
                $this->Flash->success(__('The {0} has been saved.', 'Banks Code'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Banks Code'));
            }
        }
        $banks = $this->BanksCodes->Banks->find('list', ['limit' => 200]);
        $codes = $this->BanksCodes->Codes->find('list', ['limit' => 200]);
        $this->set(compact('banksCode', 'banks', 'codes'));
        $this->set('_serialize', ['banksCode']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Banks Code id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $banksCode = $this->BanksCodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banksCode = $this->BanksCodes->patchEntity($banksCode, $this->request->data);
            if ($this->BanksCodes->save($banksCode)) {
                $this->Flash->success(__('The {0} has been saved.', 'Banks Code'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Banks Code'));
            }
        }
        $banks = $this->BanksCodes->Banks->find('list', ['limit' => 200]);
        $codes = $this->BanksCodes->Codes->find('list', ['limit' => 200]);
        $this->set(compact('banksCode', 'banks', 'codes'));
        $this->set('_serialize', ['banksCode']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Banks Code id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $banksCode = $this->BanksCodes->get($id);
        if ($this->BanksCodes->delete($banksCode)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Banks Code'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Banks Code'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
