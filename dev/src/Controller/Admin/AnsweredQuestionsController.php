<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * AnsweredQuestions Controller
 *
 * @property \App\Model\Table\AnsweredQuestionsTable $AnsweredQuestions
 */
class AnsweredQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AnsweredSurveys']
        ];
        $answeredQuestions = $this->paginate($this->AnsweredQuestions);

        $this->set(compact('answeredQuestions'));
        $this->set('_serialize', ['answeredQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Answered Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answeredQuestion = $this->AnsweredQuestions->get($id, [
            'contain' => ['AnsweredSurveys']
        ]);

        $this->set('answeredQuestion', $answeredQuestion);
        $this->set('_serialize', ['answeredQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answeredQuestion = $this->AnsweredQuestions->newEntity();
        if ($this->request->is('post')) {
            $answeredQuestion = $this->AnsweredQuestions->patchEntity($answeredQuestion, $this->request->data);
            if ($this->AnsweredQuestions->save($answeredQuestion)) {
                $this->Flash->success(__('The answered question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answered question could not be saved. Please, try again.'));
        }
        $answeredSurveys = $this->AnsweredQuestions->AnsweredSurveys->find('list', ['limit' => 200]);
        $this->set(compact('answeredQuestion', 'answeredSurveys'));
        $this->set('_serialize', ['answeredQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Answered Question id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answeredQuestion = $this->AnsweredQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answeredQuestion = $this->AnsweredQuestions->patchEntity($answeredQuestion, $this->request->data);
            if ($this->AnsweredQuestions->save($answeredQuestion)) {
                $this->Flash->success(__('The answered question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answered question could not be saved. Please, try again.'));
        }
        $answeredSurveys = $this->AnsweredQuestions->AnsweredSurveys->find('list', ['limit' => 200]);
        $this->set(compact('answeredQuestion', 'answeredSurveys'));
        $this->set('_serialize', ['answeredQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Answered Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answeredQuestion = $this->AnsweredQuestions->get($id);
        if ($this->AnsweredQuestions->delete($answeredQuestion)) {
            $this->Flash->success(__('The answered question has been deleted.'));
        } else {
            $this->Flash->error(__('The answered question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
