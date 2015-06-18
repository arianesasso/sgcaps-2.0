<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Método de inicialização
     * 
     * Este método pode ser utilizado para adicionar alguns códigos comums 
     * de inicialização. Por exemplo: carregar componentes como o Auth e o Flash
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Flash');
        //Componente customizado para facilitar algumas verificações de permissão
        $this->loadComponent('UserPermissions');
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'scope' => ['active' => 1]
                ]
            ],
            'loginAction' => ['controller' => 'Users', 'action' => 'login'],
            'loginRedirect' => ['controller' => 'Permissions', 'action' => 'organizations'],
            'logoutRedirect' => ['controller' => 'Pages', 'action' => 'display']
        ]);
        //Permite que a página inicial (home) seja exibida antes da autenticação
        $this->Auth->allow(['display']);
    }

    /**
     * Esta função será a responsável pela autorização após a autenticação do usuário
     * Em resumo: se o usuário não possuir id, não possuir permissões válidas
     * em nenhuma unidade ou na unidade em que está logado, ele será deslogado
     * 
     * Ainda, se os papéis do mesmo forem atualizados para a unidade em que está logado
     * o seu conjunto de papéis deve ser atualizado em Auth.User.roles
     * 
     * @param type $user
     * @return boolean
     */
    public function isAuthorized($user) {
        if (empty($user['id'])) {
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }

        $organizationId = $this->request->session()->read('Auth.User.organization.id');
        //Isso faz com que o usuário seja obrigado a ter uma organização selecionada
        if (empty($organizationId)) {
           return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
        
        $userRoles = $this->UserPermissions->validyRoles($user['id'], $organizationId);
        //Se o usuário não possuir papéis válidos na unidade em questão
        //Ex.: o gestor cancelou a permissão do usuário enquanto ele ainda estava logado
        if (empty($userRoles)) {
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }

        //Array com as Permissões do Usuário
        $sessionRoles = $this->request->session()->read('Auth.User.roles');

        //Se em algum momento as permissões válidas para uma dada unidade
        //forem modificadas é preciso atualizar o Auth.User.roles
        if ($sessionRoles != $userRoles) {
            $this->request->session()->write('Auth.User.roles', $userRoles);
        }
        
        return true;
    }
}
