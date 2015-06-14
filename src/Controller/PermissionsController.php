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
     * @return void Redirects the user if he/she has no validy permissions
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
            $userRoles = array();
            foreach($permissions as $permission):
                $userRoles[] = $permission['Roles']['alias'].'.'.$permission['Roles']['domain'];
            endforeach;
            //Array com as Permissões do Usuário | Array with the user permissions   
            $this->request->session()->write('Auth.User.roles', $userRoles);
            //Variável com o nome e a id da unidade atual do usuário 
            //Variable with the name and id of the current user organization
            $this->request->session()->write('Auth.User.organization.id', $organization['id']);
            $this->request->session()->write('Auth.User.organization.name', $organization['name']);
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }

        //Esta porcão de código está relacionada a criacão da interface
        //Related to the creation of the interface for the organization selection
        $permissions = $this->Permissions->find('validyorganizations', ['user_id' => $userId]);
        if (empty($permissions->toArray())) {
            $this->Auth->logout();
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
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
     * Adds a permission to an specific user
     * 
     * @param integer $userId The user to grant the permission for
     * @param integer $userType The type of user (organization or person)
     * @param integer $organizationId If the user is an organization
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($userId, $userType, $organizationId = null) {
        $this->layout = 'devoops_complete';
        $permission = $this->Permissions->newEntity();
        if ($this->request->is('post')) {
            if(!empty($this->Permissions->find('stillValid', $this->request->data)->first())) {
                $this->Flash->bootstrapError('O usuário já possui essa permissão.');
                return $this->redirect(['action' => 'add', $userId, $userType, $organizationId]);
            }
            $permission = $this->Permissions->patchEntity($permission, $this->request->data);
            if ($this->Permissions->save($permission)) {
                $this->Flash->bootstrapSuccess('A permissão foi adicionada com sucesso.');
                return $this->redirect(['action' => 'add', $userId, $userType, $organizationId]);
            } else {
                $this->Flash->bootstrapError('A permissão não pode ser salva. Por favor, tente novamente.');
            }
        }
        $organizations = $this->Permissions->Organizations->find('Allowed', ['roles' => $this->request->session()->read('Auth.User.roles'), 'organization_id' => $this->request->session()->read('Auth.User.organization.id')]);
        $roles = $this->Permissions->Roles->find('Allowed', ['roles' => $this->request->session()->read('Auth.User.roles')]);
        $user = $user = $this->Permissions->Users->get($userId, ['contain' => ['People', 'Organizations']]);;
        $this->set(compact('permission', 'organizations', 'roles'));
        $this->set('_serialize', ['permission']);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $this->set('user_type', $userType);
        $this->set('organization_id', $organizationId);
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
