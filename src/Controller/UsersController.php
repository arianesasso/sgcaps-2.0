<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    /**
     * Action that is executed before the user authentication. 
     * This is needed so the user that is not active may see 
     * the page for the users with no permissions
     * 
     * Ação que é executada antes da autenticação do usuário.
     * Ela é necessária para que o usuário que não está ativo
     * veja a página de usuário sem permissão
     * 
     * @param \Cake\Event\Event $event
     * @return type
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        $this->Auth->allow(['noPermission']);
        return parent::beforeFilter($event);
    }

    /**
     * Login method (using Auth component)
     * Método de Login (estamos usando o componente Auth do Cake)
     * 
     * @return void Redirects on successful login 
     *              Redireciona em caso de sucesso no login
     */
    public function login() {
        //O atributo redirectUrl precisa ser null, assim o usuário semprre
        //será redirecionado do login para a página de escolha de unidades
        $this->Auth->redirectUrl(null);
        $this->layout = 'devoops_minimal';

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            //Redireciona o usuário para que ele possa escolher a unidade para logar
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            //Verifica se o problema é o nome de usuário, usuário inativo ou a senha
            $users = $this->Users->findByUsername($this->request->data['username']);
            //Se o usuário não existe
            if ($users->count() === 0) {
                $this->Flash->bootstrapError('Seu nome de usuário está incorreto.');
                //Se o usuário não está ativo
            } else if (empty($users->first()->active)) {
                return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
            } else {
                $this->Flash->bootstrapError('Senha incorreta.');
            }
        }
    }

    /**
     * Logout method (using Auth component)
     * Método de logout (estamos utilizando o componente Auth do Cake)
     * 
     * @return void Redirects on successful logout
     *              Redireciona em caso de sucesso no logout
     */
    public function logout() {
        $this->Flash->bootstrapSuccess('Você encerrou sua sessão com sucesso.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Displays a message when the user has no access permission
     * Mostra uma mensagem quando o usuário não possui permissão de acesso
     * 
     * @return void Shows a static page
     *              Exibe uma página estática
     */
    public function noPermission() {
        $this->layout = 'devoops_minimal';
    }

    /**
     * Index method
     * Mostra todos os usuários
     *
     * @return void
     */
    public function index() {
        $this->layout = 'devoops_complete';
        $roles = $this->request->session()->read('Auth.User.roles');
        $organizationId = $this->request->session()->read('Auth.User.organization.id');
        $this->set('users', $this->Users->find('Allowed', ['roles' => $roles, 'organization_id' => $organizationId]));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     * Exibe um usuário específico
     *
     * @param integer $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id) {
        $this->layout = 'devoops_complete';
        $user = $this->Users->get($id, ['contain' => ['People', 'Organizations']]);

        $roles = $this->request->session()->read('Auth.User.roles');
        $organizationId = $this->request->session()->read('Auth.User.organization.id');
        $permissions = $this->Users->Permissions->find(
                'AllowedValidy', ['id' => $id, 'roles' => $roles, 'organization_id' => $organizationId]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        $this->set('permissions', $permissions);
        $this->set('_serialize', ['permissions']);
    }

    /**
     * Add method
     * Adiciona um usuário
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->layout = 'devoops_complete';
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            if (empty($this->request->data['person_id']) && empty($this->request->data['organization_id'])) {
                $this->Flash->bootstrapError('É obrigatório escolher um profissional ou unidade.');
                return $this->redirect(['controller' => 'usuario', 'action' => 'cadastrar']);
            }
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            $organizationId = empty($this->request->data['organization_id']) ? "" : $this->request->data['organization_id'];
            $userType = empty($this->request->data['person_id']) ? 'organization' : 'person'; 
            if ($this->Users->save($user)) {
                $this->redirect(['controller' => 'permissao', 'action' => 'adicionar', $user->id, $userType, $organizationId]);
            }
            $this->Flash->bootstrapError('Não foi possível criar o usuário.');           
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->layout = 'devoops_complete';
        $user = $this->Users->get($id, ['fields' => 'username']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userComplete = $this->Users->get($id);
            $user = $this->Users->patchEntity($userComplete, $this->request->data);
            if ($this->Users->save($user)) {
                /**
                 * @TODO Pensar na melhor forma de atualizar o username para o usuário logado
                 */
                $this->Flash->bootstrapSuccess('Os dados do usuário foram editados com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->bootstrapError('Os dados não foram salvos, tente novamente.');
            }
        }
        $disableUsernameEdition = true;
        if ($this->UserPermissions->hasRole($this->request->session()->read('Auth.User.roles'), 'gestor')) {
            $disableUsernameEdition = false;
        };
        $this->set('disable_username_edition', $disableUsernameEdition);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Muda a ativação de um usuário
     * Se está inativo fica ativo e vice-versa
     *
     * @param integer $id Id do Usuário
     * @param bool $active Status do Usuário (ativo/inativo)
     * @return void Redireciona para a página de visualizacão 
     *              das Permissões do usário
     */
    public function changeActivation($id, $active) {
        $this->autoRender = false;
        $change = empty($active) ? 1 : 0;
        
        $permission = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $permission = $this->Users->patchEntity($permission, ['active' => $change]);
            if (!$this->Users->save($permission)) {
                $this->Flash->bootstrapError('O status do usuário não foi modificado, por favor, tente novamente,');
                $this->redirect(['controller' => 'usuario', 'action' => 'listar']);
            }
            $this->Flash->bootstrapSuccess('Status do usuário modificado com sucesso.');
            if ($this->request->session()->read('Auth.User.id') == $id && $change === 0) {
                $this->request->session()->write('Auth.User.id', null);
            }
            return $this->redirect(['action' => 'index']);
        } else {
            $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
    }

}
