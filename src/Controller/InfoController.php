<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Info Controller
 *
 * @property \App\Model\Table\InfoTable $Info
 */
class InfoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $info = $this->paginate($this->Info);

        $this->set(compact('info'));
        $this->set('_serialize', ['info']);
    }

    /**
     * View method
     *
     * @param string|null $id Info id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $info = $this->Info->get($id, [
            'contain' => []
        ]);

        $this->set('info', $info);
        $this->set('_serialize', ['info']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $info = $this->Info->newEntity();
        if ($this->request->is('post')) {
            $info = $this->Info->patchEntity($info, $this->request->data);
            if ($this->Info->save($info)) {
                $this->Flash->success(__('The info has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The info could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('info'));
        $this->set('_serialize', ['info']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Info id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $info = $this->Info->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $info = $this->Info->patchEntity($info, $this->request->data);
            if ($this->Info->save($info)) {
                $this->Flash->success(__('The info has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The info could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('info'));
        $this->set('_serialize', ['info']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Info id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $info = $this->Info->get($id);
        if ($this->Info->delete($info)) {
            $this->Flash->success(__('The info has been deleted.'));
        } else {
            $this->Flash->error(__('The info could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
