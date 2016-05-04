<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Core\Configure;

/**
 * Task Controller
 *
 * @property \App\Model\Table\TaskTable $Task
 */
class TaskController extends AppController
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
            'contain' => ['Category']
        ];
        $task = $this->paginate($this->Task);

        $this->set(compact('task'));
        $this->set('_serialize', ['task']);
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => ['Category', 'Answer']
        ]);

        $this->set('task', $task);
        $this->set('_serialize', ['task']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Task->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Task->patchEntity($task, $this->request->data);
            $task->uploaded = false;
            $task->enabled = false;
            $task->created = new Time();
            $task->uri = null;
            $task->icon_uri = null;
            if ($this->Task->save($task)) {
                $task_id = $task->id;
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'edit', $task->id]);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $category = $this->Task->Category->find('list', ['limit' => 200]);
        $this->set(compact('task', 'category'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Task->patchEntity($task, $this->request->data);
            if ($this->Task->save($task)) {
                $this->Flash->success(__('The task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
            }
        }
        $category = $this->Task->Category->find('list', ['limit' => 200]);
        $this->set(compact('task', 'category'));
        $this->set('_serialize', ['task']);

        $this->set('taskBucketName', Configure::readOrFail('AwsS3Settings.taskBucketName'));
        $this->set('graphicsBucketName', Configure::readOrFail('AwsS3Settings.graphicsBucketName'));
        $this->set('awsAccessKey', Configure::readOrFail('AwsS3Settings.accessKey'));
        $this->set('awsSecretAccessKey', Configure::readOrFail('AwsS3Settings.secretAccessKey'));
    }

    /*
    * Method for uploading videos.
    *
    */
    public function uploadVideo($id = null)
    {
        $task = $this->Task->get($id, [
            'contain' => []
        ]);
        $category = $this->Task->Category->find('list', ['limit' => 200]);
        $this->set(compact('task', 'category'));
        $this->set('_serialize', ['task']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Task->get($id);
        if ($this->Task->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function videoUploadCompleted($id = null, $video_uri = null) {
      // Disable view rendering
      $this->autoRender = false;

      if ($id == null) {
          return;
      }
      if ($video_uri == null) {
        return;
      }

      // Update the video uri to the database.
      // If both uri's have been set, set uploaded = true.
      $task = $this->Task->get($id, [
          'contain' => []
      ]);
      $task->uri = $video_uri;
      if ($task->icon_uri != null && $task->icon_uri != '') {
        $task->uploaded = true;
      }
      $this->Task->save($task);
    }

    public function iconUploadCompleted($id = null, $icon_uri = null) {
      // Disable view rendering
      $this->autoRender = false;

      if ($id == null) {
          return;
      }
      if ($icon_uri == null) {
        return;
      }

      // Update the icon uri to the database.
      $task = $this->Task->get($id, [
          'contain' => []
      ]);
      $task->icon_uri = $icon_uri;
      if ($task->uri != null && $task->uri != '') {
        $task->uploaded = true;
      }
      $this->Task->save($task);
    }
}
