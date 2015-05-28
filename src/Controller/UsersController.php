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
     * 
     * @param type $user
     * @return boolean
     */
//    public function isAuthorized($user) {
//        $action = $this->request->params['action'];
//        // The add and index actions are always allowed.
//        if (in_array($action, ['login', 'logout'])) {
//            return true;
//        }
//
//        if ($user['id'] == 1) {
//            return true;
//        }
//        return parent::isAuthorized($user);
//    }

    /**
     * Login method (using Auth component)
     * Método de Login (estamos usando o componente Auth do Cake)
     * 
     * @return void Redirects on successful login 
     *              Redireciona em caso de sucesso no login
     */
    public function login() {
        //The redirectUrl needs to be null so the login will always redirect 
        //to the organzations action
        //O atributo redirectUrl precisa ser null, assim o usuário semprre
        //será redirecionado do login para a página de escolha de unidades
        $this->Auth->redirectUrl(null);
        $this->layout = 'devoops_minimal';

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            //Redirects the user so he can choose the unity he wants to log into
            //Redireciona o usuário para que ele possa escolher a unidade para logar
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            //Verifies whether the problem is the username, inactive user or password
            //Verifica se o problema é o nome de usuário, usuário inativo ou a senha
            $users = $this->Users->findByUsername($this->request->data['username']);
            //If the user does not exists // Se o usuário não existe
            if ($users->count() === 0) {
                $this->Flash->bootstrapError('Seu nome de usuário está incorreto.');
                //If the user is not active // Se o usuário não está ativo
            } else if (empty($users->first()->active)) {
                return $this->redirect('usuario/sem-permissao');
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
     *
     * @return void
     */
    public function index() {
        $this->layout = 'ajax';
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->layout = 'ajax';
        $user = $this->Users->get($id, [
            'contain' => ['Permissions', 'Organizations']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        //Se a requisacão não é por ajax, uma mensagem de usuário sem permissão é exibida
        if (!$this->request->is('ajax')) {
            return $this->redirect('usuario/sem-permissao');
        }        
        $this->layout = 'ajax';           
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->bootstrapSuccess('O usuário foi criado com sucesso.');
            } else {
                $this->Flash->bootstrapError('Não foi possível criar o usuário.');
            }
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
