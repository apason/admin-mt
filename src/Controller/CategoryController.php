<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Core\Configure;

/**
 * Category Controller
 *
 * @property \App\Model\Table\CategoryTable $Category
 */
class CategoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $category = $this->paginate($this->Category);

        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => ['Task']
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category = $this->Category->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Category->patchEntity($category, $this->request->data);
            $category->created = new Time();
            $category->uploaded = false;
            $category->enabled = false;
            $category->coordinate_x = 0;
            $category->coordinate_y = 0;
            $category->bg_uri = null;
            $category->icon_uri = null;
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'edit', $category->id]);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Category->patchEntity($category, $this->request->data);
            if ($this->Category->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);

        $this->set('graphicsBucketName', Configure::readOrFail('AwsS3Settings.graphicsBucketName'));
        $this->set('awsAccessKey', Configure::readOrFail('AwsS3Settings.accessKey'));
        $this->set('awsSecretAccessKey', Configure::readOrFail('AwsS3Settings.secretAccessKey'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Category->get($id);
        if ($this->Category->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function backgroundUploadCompleted($id = null, $background_uri = null) {
      // Disable view rendering
      $this->autoRender = false;

      if ($id == null) {
          return;
      }
      if ($background_uri == null) {
        return;
      }

      // Update the background uri to the database.
      // If both uri's have been set, set uploaded = true.
      $category = $this->Category->get($id, [
          'contain' => []
      ]);
      $category->bg_uri = $background_uri;
      if ($category->icon_uri != null && $category->icon_uri != '') {
        $category->uploaded = true;
      }
      $this->Category->save($category);
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
      $category = $this->Category->get($id, [
          'contain' => []
      ]);
      $category->icon_uri = $icon_uri;
      if ($category->bg_uri != null && $category->bg_uri != '') {
        $category->uploaded = true;
      }
      $this->Category->save($category);
    }
}
