<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController {

//    /**
//     * 
//     * @param type $user
//     * @return boolean
//     */
//    public function isAuthorized($user) {
//        $action = $this->request->params['action'];
//        // The add and index actions are always allowed.
//        if (in_array($action, ['index', 'main'])) {
//            return true;
//        }
//        return parent::isAuthorized($user);
//    }
    
     /**
     * If the organization was not selected, redirect the user so he can choose it
     * Se a organizaćão não foi selecionada, redireciona o usuário para selecioná-la
     * 
     * @param \Cake\Event\Event $event
     * @return type
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        if(empty($this->request->session()->read('Auth.User.organization'))) {
            $this->redirect('permissao/unidade');
        }
        return parent::beforeFilter($event);
    }

    /**
     * Creates the main structure of the page
     *
     * @return void
     */
    public function index() {
        $this->layout = 'devoops_complete';
    }

    /**
     * Shows the dashboard
     * 
     * @return void
     */
    public function main() {
        $this->layout = 'ajax';
    }

}
