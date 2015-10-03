<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Indicators Controller
 *
 */
class IndicatorsController extends AppController {
    
    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $actions = $this->request->session()->read('Auth.User.actions');
        $controller = $this->request->controller;
        $action = $this->request->action;
        return $this->UserPermissions->isAuthorized($actions, $controller, $action);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function demographic() {
        $this->viewBuilder()->layout('devoops_complete');
    }

}
