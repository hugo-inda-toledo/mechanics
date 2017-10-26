<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RequestsFiles Controller
 *
 * @property \App\Model\Table\RequestsFilesTable $RequestsFiles
 */
class RequestsFilesController extends AppController
{

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
        $requestsFiles = $this->paginate($this->RequestsFiles);

        $this->set(compact('requestsFiles'));
        $this->set('_serialize', ['requestsFiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Requests File id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestsFile = $this->RequestsFiles->get($id, [
            'contain' => ['Requests']
        ]);

        $this->set('requestsFile', $requestsFile);
        $this->set('_serialize', ['requestsFile']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestsFile = $this->RequestsFiles->newEntity();
        if ($this->request->is('post')) {
            $requestsFile = $this->RequestsFiles->patchEntity($requestsFile, $this->request->data);
            if ($this->RequestsFiles->save($requestsFile)) {
                $this->Flash->success(__('The requests file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests file could not be saved. Please, try again.'));
        }
        $requests = $this->RequestsFiles->Requests->find('list', ['limit' => 200]);
        $this->set(compact('requestsFile', 'requests'));
        $this->set('_serialize', ['requestsFile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Requests File id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestsFile = $this->RequestsFiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestsFile = $this->RequestsFiles->patchEntity($requestsFile, $this->request->data);
            if ($this->RequestsFiles->save($requestsFile)) {
                $this->Flash->success(__('The requests file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests file could not be saved. Please, try again.'));
        }
        $requests = $this->RequestsFiles->Requests->find('list', ['limit' => 200]);
        $this->set(compact('requestsFile', 'requests'));
        $this->set('_serialize', ['requestsFile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Requests File id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestsFile = $this->RequestsFiles->get($id);
        if ($this->RequestsFiles->delete($requestsFile)) {
            $this->Flash->success(__('The requests file has been deleted.'));
        } else {
            $this->Flash->error(__('The requests file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
