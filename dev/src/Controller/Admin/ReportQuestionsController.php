<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReportQuestions Controller
 *
 * @property \App\Model\Table\ReportQuestionsTable $ReportQuestions
 */
class ReportQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ReportQuestionCategories', 'ReportQuestionGroups']
        ];
        $reportQuestions = $this->paginate($this->ReportQuestions);

        $this->set(compact('reportQuestions'));
        $this->set('_serialize', ['reportQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportQuestion = $this->ReportQuestions->get($id, [
            'contain' => ['ReportQuestionCategories', 'ReportQuestionGroups', 'ReportQuestionAlternatives', 'ReportQuestionAnswers']
        ]);

        $this->set('reportQuestion', $reportQuestion);
        $this->set('_serialize', ['reportQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportQuestion = $this->ReportQuestions->newEntity();
        if ($this->request->is('post')) {
            $reportQuestion = $this->ReportQuestions->patchEntity($reportQuestion, $this->request->data);
            if ($this->ReportQuestions->save($reportQuestion)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question'));
            }
        }
        $reportQuestionCategories = $this->ReportQuestions->ReportQuestionCategories->find('list', ['limit' => 200]);
        $reportQuestionGroups = $this->ReportQuestions->ReportQuestionGroups->find('list', ['limit' => 200]);
        $this->set(compact('reportQuestion', 'reportQuestionCategories', 'reportQuestionGroups'));
        $this->set('_serialize', ['reportQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportQuestion = $this->ReportQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportQuestion = $this->ReportQuestions->patchEntity($reportQuestion, $this->request->data);
            if ($this->ReportQuestions->save($reportQuestion)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question'));
            }
        }
        $reportQuestionCategories = $this->ReportQuestions->ReportQuestionCategories->find('list', ['limit' => 200]);
        $reportQuestionGroups = $this->ReportQuestions->ReportQuestionGroups->find('list', ['limit' => 200]);
        $this->set(compact('reportQuestion', 'reportQuestionCategories', 'reportQuestionGroups'));
        $this->set('_serialize', ['reportQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportQuestion = $this->ReportQuestions->get($id);
        if ($this->ReportQuestions->delete($reportQuestion)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Report Question'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Report Question'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
