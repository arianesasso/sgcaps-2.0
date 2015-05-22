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
        //Se houve uma requisicão do tipo POST, salvar o nome da organizacão
        //na variável de sessão Auth.User e redirecionar para o dashboard
        if ($this->request->is('post')) {
            list($organization['id'], $organization['name']) = explode('/', $this->request->data['unidade']);
            $permissions = $this->Permissions->find('validyroles', ['user_id' => $userId, 'organization_id' => $organization['id']]);

            //Array com as Permissões do Usuário | Array with the user permissions   
            $this->request->session()->write('Auth.User.roles', $permissions->toArray());
            //Array com o nome da unidade atual do usuário 
            //Array with the name of the current user organization
            $this->request->session()->write('Auth.User.organization', $organization['name']);
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        //Esta porcão decódigo está relacionada a criacão da interface
        //Related to the creation of the interface for the organization selection
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
