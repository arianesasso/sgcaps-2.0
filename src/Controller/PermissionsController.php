<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Permissions Controller
 *
 * @property \App\Model\Table\PermissionsTable $Permissions
 */
class PermissionsController extends AppController {
    
     /**
     * 
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        // A 
        if (in_array($action, ['organizations'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    /**
     * Shows the organizations that the user has permission to access
     * Mostra as unidades que o usuário tem permissão de acessar
     * 
     * @param integer $userId Id do Usuário
     * @return void Redirects the user if he/she has no validy permissions
     *              Redireciona o usuário se ele não tiver permissões válidas
     */
    public function organizations() {
        $this->layout = 'devoops_minimal';
        $userId = $this->request->session()->read('Auth.User.id');
        //Se houve uma requisicão do tipo POST, salvar o nome da organizacão 
        //Redirecionar para o dashboard
        if ($this->request->is('post')) {
            list($organization['id'], $organization['name']) = explode('/', $this->request->data['unidade']);
            $userRoles = $this->UserPermissions->validyRoles($userId, $organizationId);
            //Array com as Permissões do Usuário | Array with the user permissions   
            $this->request->session()->write('Auth.User.roles', $userRoles);
            //Variável com o nome e a id da unidade atual do usuário
            $this->request->session()->write('Auth.User.organization.id', $organization['id']);
            $this->request->session()->write('Auth.User.organization.name', $organization['name']);
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }
        //Esta porcão de código está relacionada a criacão da interface
        $permissions = $this->Permissions->find('validyorganizations', ['user_id' => $userId]);
        $this->set(compact('permissions'));
    }

    /**
     * Adds a permission to an specific user
     * Adiciona uma permissão a um usuário específico
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
            if (!empty($this->Permissions->find('stillValid', $this->request->data)->first())) {
                $this->Flash->bootstrapError('O usuário já possui essa permissão.');
                return $this->redirect(['action' => 'add', $userId, $userType, $organizationId]);
            }
            $permission = $this->Permissions->patchEntity($permission, $this->request->data);
            if ($this->Permissions->save($permission)) {
                $this->Flash->bootstrapSuccess('A permissão foi adicionada com sucesso.');
                return $this->redirect(['controller' => 'usuario', 'action' => 'visualizar', $userId]);
            } else {
                $this->Flash->bootstrapError('A permissão não pode ser salva. Por favor, tente novamente.');
            }
        }
        $organizations = $this->Permissions->Organizations->find('Allowed', ['roles' => $this->request->session()->read('Auth.User.roles'), 'organization_id' => $this->request->session()->read('Auth.User.organization.id')]);
        $roles = $this->Permissions->Roles->find('Allowed', ['roles' => $this->request->session()->read('Auth.User.roles')]);
        $user = $user = $this->Permissions->Users->get($userId, ['contain' => ['People', 'Organizations']]);
        ;
        $this->set(compact('permission', 'organizations', 'roles'));
        $this->set('_serialize', ['permission']);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $this->set('user_type', $userType);
        $this->set('organization_id', $organizationId);
    }

    /**
     * Cancela uma determinada permissão de um usuário
     *
     * @param integer $id Id da Permissão
     * @param integer $userId Id do Usuário
     * @return void Redireciona para a página de visualizacão 
     *              das Permissões do usário
     */
    public function cancel($id, $userId) {
        $this->autoRender = false;
        $permission = $this->Permissions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permission = $this->Permissions->patchEntity($permission, ['ending' => Time::now()]);
            if ($this->Permissions->save($permission)) {
                $this->Flash->bootstrapSuccess('Permissão cancelada com sucesso.');
                return $this->redirect(['controller' => 'usuario', 'action' => 'visualizar', $userId]);
            } else {
                $this->Flash->bootstrapError('A permissão não foi cancelada, por favor, tente novamente,');
                return $this->redirect(['controller' => 'usuario', 'action' => 'visualizar', $userId]);
            }
        } else {
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
    }

}
