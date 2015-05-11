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
