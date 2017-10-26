<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * HealthReports Controller
 *
 * @property \App\Model\Table\HealthReportsTable $HealthReports
 */
class HealthReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests', 'Cars']
        ];
        $healthReports = $this->paginate($this->HealthReports);

        $this->set(compact('healthReports'));
        $this->set('_serialize', ['healthReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Health Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $healthReport = $this->HealthReports->get($id, [
            'contain' => ['Requests', 'Cars']
        ]);

        $this->set('healthReport', $healthReport);
        $this->set('_serialize', ['healthReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $healthReport = $this->HealthReports->newEntity();
        if ($this->request->is('post')) {
            $healthReport = $this->HealthReports->patchEntity($healthReport, $this->request->data);
            if ($this->HealthReports->save($healthReport)) {
                $this->Flash->success(__('The health report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The health report could not be saved. Please, try again.'));
        }
        $requests = $this->HealthReports->Requests->find('list', ['limit' => 200]);
        $cars = $this->HealthReports->Cars->find('list', ['limit' => 200]);
        $this->set(compact('healthReport', 'requests', 'cars'));
        $this->set('_serialize', ['healthReport']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Health Report id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $healthReport = $this->HealthReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $healthReport = $this->HealthReports->patchEntity($healthReport, $this->request->data);
            if ($this->HealthReports->save($healthReport)) {
                $this->Flash->success(__('The health report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The health report could not be saved. Please, try again.'));
        }
        $requests = $this->HealthReports->Requests->find('list', ['limit' => 200]);
        $cars = $this->HealthReports->Cars->find('list', ['limit' => 200]);
        $this->set(compact('healthReport', 'requests', 'cars'));
        $this->set('_serialize', ['healthReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Health Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $healthReport = $this->HealthReports->get($id);
        if ($this->HealthReports->delete($healthReport)) {
            $this->Flash->success(__('The health report has been deleted.'));
        } else {
            $this->Flash->error(__('The health report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
