<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController {

    /**
     * Creates the main structure of the page
     * Cria a estrutura principal da página
     *
     * @return void
     */
    public function index() {
        $this->layout = 'devoops_complete';
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
    }

}
