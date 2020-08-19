<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        return true;
    }

    /**
     * Creates the main structure of the page
     * Cria a estrutura principal da página
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->setLayout('devoops_complete');
    }

}
