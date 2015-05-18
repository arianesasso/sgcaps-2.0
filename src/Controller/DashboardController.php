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
