<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * AnsweredSurveys Controller
 *
 * @property \App\Model\Table\AnsweredSurveysTable $AnsweredSurveys
 */
class AnsweredSurveysController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Surveys', 'Users', 'Requests']
        ];
        $answeredSurveys = $this->paginate($this->AnsweredSurveys);

        $this->set(compact('answeredSurveys'));
        $this->set('_serialize', ['answeredSurveys']);
    }

    /**
     * View method
     *
     * @param string|null $id Answered Survey id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answeredSurvey = $this->AnsweredSurveys->get($id, [
            'contain' => ['Surveys', 'Users', 'Requests']
        ]);

        $this->set('answeredSurvey', $answeredSurvey);
        $this->set('_serialize', ['answeredSurvey']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answeredSurvey = $this->AnsweredSurveys->newEntity();
        if ($this->request->is('post')) {
            $answeredSurvey = $this->AnsweredSurveys->patchEntity($answeredSurvey, $this->request->data);
            if ($this->AnsweredSurveys->save($answeredSurvey)) {
                $this->Flash->success(__('The answered survey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answered survey could not be saved. Please, try again.'));
        }
        $surveys = $this->AnsweredSurveys->Surveys->find('list', ['limit' => 200]);
        $users = $this->AnsweredSurveys->Users->find('list', ['limit' => 200]);
        $requests = $this->AnsweredSurveys->Requests->find('list', ['limit' => 200]);
        $this->set(compact('answeredSurvey', 'surveys', 'users', 'requests'));
        $this->set('_serialize', ['answeredSurvey']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Answered Survey id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answeredSurvey = $this->AnsweredSurveys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answeredSurvey = $this->AnsweredSurveys->patchEntity($answeredSurvey, $this->request->data);
            if ($this->AnsweredSurveys->save($answeredSurvey)) {
                $this->Flash->success(__('The answered survey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The answered survey could not be saved. Please, try again.'));
        }
        $surveys = $this->AnsweredSurveys->Surveys->find('list', ['limit' => 200]);
        $users = $this->AnsweredSurveys->Users->find('list', ['limit' => 200]);
        $requests = $this->AnsweredSurveys->Requests->find('list', ['limit' => 200]);
        $this->set(compact('answeredSurvey', 'surveys', 'users', 'requests'));
        $this->set('_serialize', ['answeredSurvey']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Answered Survey id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answeredSurvey = $this->AnsweredSurveys->get($id);
        if ($this->AnsweredSurveys->delete($answeredSurvey)) {
            $this->Flash->success(__('The answered survey has been deleted.'));
        } else {
            $this->Flash->error(__('The answered survey could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
