<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReportQuestionCategories Controller
 *
 * @property \App\Model\Table\ReportQuestionCategoriesTable $ReportQuestionCategories
 */
class ReportQuestionCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reportQuestionCategories = $this->paginate($this->ReportQuestionCategories);

        $this->set(compact('reportQuestionCategories'));
        $this->set('_serialize', ['reportQuestionCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Question Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportQuestionCategory = $this->ReportQuestionCategories->get($id, [
            'contain' => ['ReportQuestionAnswers', 'ReportQuestions']
        ]);

        $this->set('reportQuestionCategory', $reportQuestionCategory);
        $this->set('_serialize', ['reportQuestionCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportQuestionCategory = $this->ReportQuestionCategories->newEntity();
        if ($this->request->is('post')) {
            $reportQuestionCategory = $this->ReportQuestionCategories->patchEntity($reportQuestionCategory, $this->request->data);
            if ($this->ReportQuestionCategories->save($reportQuestionCategory)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Category'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Category'));
            }
        }
        $this->set(compact('reportQuestionCategory'));
        $this->set('_serialize', ['reportQuestionCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Question Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportQuestionCategory = $this->ReportQuestionCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportQuestionCategory = $this->ReportQuestionCategories->patchEntity($reportQuestionCategory, $this->request->data);
            if ($this->ReportQuestionCategories->save($reportQuestionCategory)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Category'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Category'));
            }
        }
        $this->set(compact('reportQuestionCategory'));
        $this->set('_serialize', ['reportQuestionCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Question Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportQuestionCategory = $this->ReportQuestionCategories->get($id);
        if ($this->ReportQuestionCategories->delete($reportQuestionCategory)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Report Question Category'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Report Question Category'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
