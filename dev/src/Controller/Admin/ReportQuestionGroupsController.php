<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReportQuestionGroups Controller
 *
 * @property \App\Model\Table\ReportQuestionGroupsTable $ReportQuestionGroups
 */
class ReportQuestionGroupsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reportQuestionGroups = $this->paginate($this->ReportQuestionGroups);

        $this->set(compact('reportQuestionGroups'));
        $this->set('_serialize', ['reportQuestionGroups']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Question Group id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportQuestionGroup = $this->ReportQuestionGroups->get($id, [
            'contain' => []
        ]);

        $this->set('reportQuestionGroup', $reportQuestionGroup);
        $this->set('_serialize', ['reportQuestionGroup']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportQuestionGroup = $this->ReportQuestionGroups->newEntity();
        if ($this->request->is('post')) {
            $reportQuestionGroup = $this->ReportQuestionGroups->patchEntity($reportQuestionGroup, $this->request->data);
            if ($this->ReportQuestionGroups->save($reportQuestionGroup)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Group'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Group'));
            }
        }
        $this->set(compact('reportQuestionGroup'));
        $this->set('_serialize', ['reportQuestionGroup']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Question Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportQuestionGroup = $this->ReportQuestionGroups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportQuestionGroup = $this->ReportQuestionGroups->patchEntity($reportQuestionGroup, $this->request->data);
            if ($this->ReportQuestionGroups->save($reportQuestionGroup)) {
                $this->Flash->success(__('The {0} has been saved.', 'Report Question Group'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Report Question Group'));
            }
        }
        $this->set(compact('reportQuestionGroup'));
        $this->set('_serialize', ['reportQuestionGroup']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Question Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportQuestionGroup = $this->ReportQuestionGroups->get($id);
        if ($this->ReportQuestionGroups->delete($reportQuestionGroup)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Report Question Group'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Report Question Group'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
