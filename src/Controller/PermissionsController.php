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
     * A única página que qualquer usuário logado tem autorização de acessar
     * é a página que permite a ele escolher a organização na qual deseja realizar
     * ações
     * 
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user) {
        $action = $this->request->params['action'];
        if (in_array($action, ['organizations'])) {
            $organizations = $this->UserPermissions->validyOrganizations($user['id']);
            //Se o usuário não possuir permissões válidas em nenhuma organização
            if (empty($organizations)) {
                return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
            } else {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    /**
     * Shows the organizations that the user has permission to access
     * Mostra as unidades que o usuário tem permissão de acessar
     * 
     * @return void Redireciona o usuário para o dashboard após escolha da organização
     */
    public function organizations() {
        $this->layout = 'devoops_minimal';
        $userId = $this->request->session()->read('Auth.User.id');
        //Caso seja uma requisicão do tipo POST, salvar dados da organizacão e os papéis do usuário
        if ($this->request->is('post')) {
            list($organization['id'], $organization['name']) = explode('/', $this->request->data['unidade']);
            $userRoles = $this->UserPermissions->validyRoles($userId, $organization['id']);
            //Array com as Permissões do Usuário  
            $this->request->session()->write('Auth.User.roles', $userRoles);
            //Variável com o nome e o id da unidade atual do usuário
            $this->request->session()->write('Auth.User.organization.id', $organization['id']);
            $this->request->session()->write('Auth.User.organization.name', $organization['name']);
            return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
        }
        //Esta porção de código está relacionada a criacão da interface
        $permissions = $this->Permissions->find('validyorganizations', ['user_id' => $userId]);
        $this->set(compact('permissions'));
    }

    /**
     * Adds a permission to an specific user
     * Adiciona uma permissão a um usuário específico
     * 
     * @param integer $userId O usuário que terá a permissão garantida
     * @param integer $userType Tipo de usuário (organização ou pessoa)
     * @param integer $organizationId Se o usuário for uma organização
     * @return void Carrega a view ou redireciona para a página do usuário após
     *              garantir a permissão
     */
    public function add($userId, $userType, $organizationId = null) {
        $this->layout = 'devoops_complete';
        $permission = $this->Permissions->newEntity();
        if ($this->request->is('post')) {
            //Se a permissão em questão for válida atualmente
            $stillValid = $this->Permissions->find('stillValid', $this->request->data)->first();
            if (!empty($stillValid)) {
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
        //Encontra as organizações para as quais um determinado usuário pode garantir permissões
        $organizations = $this->Permissions->Organizations->find('Allowed', ['roles' => $this->request->session()->read('Auth.User.roles'), 'organization_id' => $this->request->session()->read('Auth.User.organization.id')]);
        //Encontra os papéis que um determinado usuário pode garantir
        $roles = $this->Permissions->Roles->find('Allowed', ['roles' => $this->request->session()->read('Auth.User.roles')]);
        //Recupera dados do usuário que está tendo a permissão garantida
        $user = $this->Permissions->Users->get($userId, ['contain' => ['People', 'Organizations']]);
        
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
     * @return void Redireciona para a página de visualizacão das Permissões do usário
     *              em caso de sucesso
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
