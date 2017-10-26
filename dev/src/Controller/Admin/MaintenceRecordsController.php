<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * MaintenceRecords Controller
 *
 * @property \App\Model\Table\MaintenceRecordsTable $MaintenceRecords
 */
class MaintenceRecordsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cars']
        ];
        $maintenceRecords = $this->paginate($this->MaintenceRecords);

        $this->set(compact('maintenceRecords'));
        $this->set('_serialize', ['maintenceRecords']);
    }

    /**
     * View method
     *
     * @param string|null $id Maintence Record id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $maintenceRecord = $this->MaintenceRecords->get($id, [
            'contain' => ['Cars']
        ]);

        $this->set('maintenceRecord', $maintenceRecord);
        $this->set('_serialize', ['maintenceRecord']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $maintenceRecord = $this->MaintenceRecords->newEntity();
        if ($this->request->is('post')) {
            $maintenceRecord = $this->MaintenceRecords->patchEntity($maintenceRecord, $this->request->data);
            if ($this->MaintenceRecords->save($maintenceRecord)) {
                $this->Flash->success(__('The maintence record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintence record could not be saved. Please, try again.'));
        }
        $cars = $this->MaintenceRecords->Cars->find('list', ['limit' => 200]);
        $this->set(compact('maintenceRecord', 'cars'));
        $this->set('_serialize', ['maintenceRecord']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Maintence Record id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $maintenceRecord = $this->MaintenceRecords->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $maintenceRecord = $this->MaintenceRecords->patchEntity($maintenceRecord, $this->request->data);
            if ($this->MaintenceRecords->save($maintenceRecord)) {
                $this->Flash->success(__('The maintence record has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The maintence record could not be saved. Please, try again.'));
        }
        $cars = $this->MaintenceRecords->Cars->find('list', ['limit' => 200]);
        $this->set(compact('maintenceRecord', 'cars'));
        $this->set('_serialize', ['maintenceRecord']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Maintence Record id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $maintenceRecord = $this->MaintenceRecords->get($id);
        if ($this->MaintenceRecords->delete($maintenceRecord)) {
            $this->Flash->success(__('The maintence record has been deleted.'));
        } else {
            $this->Flash->error(__('The maintence record could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
