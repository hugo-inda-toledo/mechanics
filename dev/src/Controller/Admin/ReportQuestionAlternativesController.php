<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReportQuestionAlternatives Controller
 *
 * @property \App\Model\Table\ReportQuestionAlternativesTable $ReportQuestionAlternatives
 */
class ReportQuestionAlternativesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ReportQuestions']
        ];
        $reportQuestionAlternatives = $this->paginate($this->ReportQuestionAlternatives);

        $this->set(compact('reportQuestionAlternatives'));
        $this->set('_serialize', ['reportQuestionAlternatives']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Question Alternative id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportQuestionAlternative = $this->ReportQuestionAlternatives->get($id, [
            'contain' => ['ReportQuestions', 'ReportQuestionAnswers']
        ]);

        $this->set('reportQuestionAlternative', $reportQuestionAlternative);
        $this->set('_serialize', ['reportQuestionAlternative']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportQuestionAlternative = $this->ReportQuestionAlternatives->newEntity();
        if ($this->request->is('post')) {
            $reportQuestionAlternative = $this->ReportQuestionAlternatives->patchEntity($reportQuestionAlternative, $this->request->data);
            if ($this->ReportQuestionAlternatives->save($reportQuestionAlternative)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Alternative'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Alternative'));
            }
        }
        $reportQuestions = $this->ReportQuestionAlternatives->ReportQuestions->find('list', ['limit' => 200]);
        $this->set(compact('reportQuestionAlternative', 'reportQuestions'));
        $this->set('_serialize', ['reportQuestionAlternative']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Question Alternative id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportQuestionAlternative = $this->ReportQuestionAlternatives->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportQuestionAlternative = $this->ReportQuestionAlternatives->patchEntity($reportQuestionAlternative, $this->request->data);
            if ($this->ReportQuestionAlternatives->save($reportQuestionAlternative)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Alternative'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Alternative'));
            }
        }
        $reportQuestions = $this->ReportQuestionAlternatives->ReportQuestions->find('list', ['limit' => 200]);
        $this->set(compact('reportQuestionAlternative', 'reportQuestions'));
        $this->set('_serialize', ['reportQuestionAlternative']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Question Alternative id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportQuestionAlternative = $this->ReportQuestionAlternatives->get($id);
        if ($this->ReportQuestionAlternatives->delete($reportQuestionAlternative)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Report Question Alternative'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Report Question Alternative'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
