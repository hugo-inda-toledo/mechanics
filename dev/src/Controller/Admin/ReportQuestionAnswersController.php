<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReportQuestionAnswers Controller
 *
 * @property \App\Model\Table\ReportQuestionAnswersTable $ReportQuestionAnswers
 */
class ReportQuestionAnswersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ReportQuestions', 'ReportQuestionAlternatives', 'ReportQuestionCategories', 'Reports']
        ];
        $reportQuestionAnswers = $this->paginate($this->ReportQuestionAnswers);

        $this->set(compact('reportQuestionAnswers'));
        $this->set('_serialize', ['reportQuestionAnswers']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Question Answer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportQuestionAnswer = $this->ReportQuestionAnswers->get($id, [
            'contain' => ['ReportQuestions', 'ReportQuestionAlternatives', 'ReportQuestionCategories', 'Reports']
        ]);

        $this->set('reportQuestionAnswer', $reportQuestionAnswer);
        $this->set('_serialize', ['reportQuestionAnswer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportQuestionAnswer = $this->ReportQuestionAnswers->newEntity();
        if ($this->request->is('post')) {
            $reportQuestionAnswer = $this->ReportQuestionAnswers->patchEntity($reportQuestionAnswer, $this->request->data);
            if ($this->ReportQuestionAnswers->save($reportQuestionAnswer)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Answer'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Answer'));
            }
        }
        $reportQuestions = $this->ReportQuestionAnswers->ReportQuestions->find('list', ['limit' => 200]);
        $reportQuestionAlternatives = $this->ReportQuestionAnswers->ReportQuestionAlternatives->find('list', ['limit' => 200]);
        $reportQuestionCategories = $this->ReportQuestionAnswers->ReportQuestionCategories->find('list', ['limit' => 200]);
        $reports = $this->ReportQuestionAnswers->Reports->find('list', ['limit' => 200]);
        $this->set(compact('reportQuestionAnswer', 'reportQuestions', 'reportQuestionAlternatives', 'reportQuestionCategories', 'reports'));
        $this->set('_serialize', ['reportQuestionAnswer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Question Answer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportQuestionAnswer = $this->ReportQuestionAnswers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportQuestionAnswer = $this->ReportQuestionAnswers->patchEntity($reportQuestionAnswer, $this->request->data);
            if ($this->ReportQuestionAnswers->save($reportQuestionAnswer)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Answer'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Answer'));
            }
        }
        $reportQuestions = $this->ReportQuestionAnswers->ReportQuestions->find('list', ['limit' => 200]);
        $reportQuestionAlternatives = $this->ReportQuestionAnswers->ReportQuestionAlternatives->find('list', ['limit' => 200]);
        $reportQuestionCategories = $this->ReportQuestionAnswers->ReportQuestionCategories->find('list', ['limit' => 200]);
        $reports = $this->ReportQuestionAnswers->Reports->find('list', ['limit' => 200]);
        $this->set(compact('reportQuestionAnswer', 'reportQuestions', 'reportQuestionAlternatives', 'reportQuestionCategories', 'reports'));
        $this->set('_serialize', ['reportQuestionAnswer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Question Answer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportQuestionAnswer = $this->ReportQuestionAnswers->get($id);
        if ($this->ReportQuestionAnswers->delete($reportQuestionAnswer)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Report Question Answer'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Report Question Answer'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
