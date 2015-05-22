<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Permissions Controller
 *
 * @property \App\Model\Table\PermissionsTable $Permissions
 */
class PermissionsController extends AppController {

    /**
     * Action that is executed before the user authentication. 
     * This is needed so the user that is not active may see 
     * the inactive users page
     * 
     * @param \Cake\Event\Event $event
     * @return type
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['view']);
        return parent::beforeFilter($event);
    }

    /**
     * Shows the organizations that the user has permission to access
     * Mostra as unidades que o usuário tem permissão de acessar
     * 
     * @param integer $userId
     * @return void Redirects the user if it has not validy permissions
     *              Redireciona o usuário se ele não tiver permissões válidas
     */
    public function organizations() {
        $this->layout = 'devoops_minimal';
        $userId = $this->request->session()->read('Auth.User.id');

        $permissions = $this->Permissions->find('validyorganizations', ['user_id' => $userId]);

        if (empty($permissions->toArray())) {
            $this->Auth->logout();
            return $this->redirect('usuario/sem-permissao');
        }
        $this->set(compact('permissions'));
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Organizations', 'Roles']
        ];
        $this->set('permissions', $this->paginate($this->Permissions));
        $this->set('_serialize', ['permissions']);
    }

    /**
     * View method
     *
     * @param string|null $id Permission id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $permission = $this->Permissions->get($id, [
            'contain' => ['Users', 'Organizations', 'Roles']
        ]);
        $this->set('permission', $permission);
        $this->set('_serialize', ['permission']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $permission = $this->Permissions->newEntity();
        if ($this->request->is('post')) {
            $permission = $this->Permissions->patchEntity($permission, $this->request->data);
            if ($this->Permissions->save($permission)) {
                $this->Flash->success('The permission has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The permission could not be saved. Please, try again.');
            }
        }
        $users = $this->Permissions->Users->find('list', ['limit' => 200]);
        $organizations = $this->Permissions->Organizations->find('list', ['limit' => 200]);
        $roles = $this->Permissions->Roles->find('list', ['limit' => 200]);
        $this->set(compact('permission', 'users', 'organizations', 'roles'));
        $this->set('_serialize', ['permission']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Permission id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $permission = $this->Permissions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permission = $this->Permissions->patchEntity($permission, $this->request->data);
            if ($this->Permissions->save($permission)) {
                $this->Flash->success('The permission has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The permission could not be saved. Please, try again.');
            }
        }
        $users = $this->Permissions->Users->find('list', ['limit' => 200]);
        $organizations = $this->Permissions->Organizations->find('list', ['limit' => 200]);
        $roles = $this->Permissions->Roles->find('list', ['limit' => 200]);
        $this->set(compact('permission', 'users', 'organizations', 'roles'));
        $this->set('_serialize', ['permission']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Permission id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $permission = $this->Permissions->get($id);
        if ($this->Permissions->delete($permission)) {
            $this->Flash->success('The permission has been deleted.');
        } else {
            $this->Flash->error('The permission could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
