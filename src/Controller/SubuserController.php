<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subuser Controller
 *
 * @property \App\Model\Table\SubuserTable $Subuser
 */
class SubuserController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['User']
        ];
        $subuser = $this->paginate($this->Subuser);

        $this->set(compact('subuser'));
        $this->set('_serialize', ['subuser']);
    }

    /**
     * View method
     *
     * @param string|null $id Subuser id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subuser = $this->Subuser->get($id, [
            'contain' => ['User', 'Answer', 'Likes']
        ]);

        $this->set('subuser', $subuser);
        $this->set('_serialize', ['subuser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subuser = $this->Subuser->newEntity();
        if ($this->request->is('post')) {
            $subuser = $this->Subuser->patchEntity($subuser, $this->request->data);
            if ($this->Subuser->save($subuser)) {
                $this->Flash->success(__('The subuser has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subuser could not be saved. Please, try again.'));
            }
        }
        $user = $this->Subuser->User->find('list', ['limit' => 200]);
        $this->set(compact('subuser', 'user'));
        $this->set('_serialize', ['subuser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subuser id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subuser = $this->Subuser->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subuser = $this->Subuser->patchEntity($subuser, $this->request->data);
            if ($this->Subuser->save($subuser)) {
                $this->Flash->success(__('The subuser has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subuser could not be saved. Please, try again.'));
            }
        }
        $user = $this->Subuser->User->find('list', ['limit' => 200]);
        $this->set(compact('subuser', 'user'));
        $this->set('_serialize', ['subuser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subuser id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subuser = $this->Subuser->get($id);
        if ($this->Subuser->delete($subuser)) {
            $this->Flash->success(__('The subuser has been deleted.'));
        } else {
            $this->Flash->error(__('The subuser could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
