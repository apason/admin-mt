<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Answer Controller
 *
 * @property \App\Model\Table\AnswerTable $Answer
 */
class AnswerController extends AppController
{
  public function initialize() {
    parent::initialize();
    $this->loadComponent('MtS3Service', array());
  }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Task', 'Subuser']
        ];
        $answer = $this->paginate($this->Answer);

        $this->set(compact('answer'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * View method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answer = $this->Answer->get($id, [
            'contain' => ['Task', 'Subuser', 'Likes']
        ]);

        $this->set('answer', $answer);
        $this->set('signed_download_url', $this->MtS3Service->getSignedAnswerDownloadUrl($answer->uri));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answer = $this->Answer->newEntity();
        if ($this->request->is('post')) {
            $answer = $this->Answer->patchEntity($answer, $this->request->data);
            if ($this->Answer->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
        $task = $this->Answer->Task->find('list', ['limit' => 200]);
        $subuser = $this->Answer->Subuser->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'task', 'subuser'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answer = $this->Answer->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->Answer->patchEntity($answer, $this->request->data);
            if ($this->Answer->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
        $task = $this->Answer->Task->find('list', ['limit' => 200]);
        $subuser = $this->Answer->Subuser->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'task', 'subuser'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answer = $this->Answer->get($id);
        if ($this->Answer->delete($answer)) {
            $this->Flash->success(__('The answer has been deleted.'));
        } else {
            $this->Flash->error(__('The answer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
