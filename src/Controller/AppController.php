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
     * Initialization hook method.
     * Método de inicialização
     *
     * Use this method to add common initialization code like loading components
     * Esse método pode ser utilizado para adicionar alguns códigos comums 
     * de inicialização. Por exemplo: carregar componentes como o Auth e o Flash
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('UserPermissions');
        $this->loadComponent('Auth', [
            //'authorize' => 'Controller',
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
        // Allows the display action so we can see the Home
        // Permite que a página inicial (Home) seja exibida antes da autenticação
        $this->Auth->allow(['display']);
    }

    /**
     * In the beggining no user is authorized
     * No início, nenhum usuário está autorizado
     * 
     * @param type $user
     * @return boolean
     */
//    public function isAuthorized($user) {
//        return false;
//    }
}
