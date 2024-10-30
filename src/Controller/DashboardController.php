<?php
namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController {

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');

        // Allow unauthenticated access to the index action
        $this->Authentication->allowUnauthenticated(['index']);
    }
    public function index() {
        $this->set('title', 'Dashboard');
    }
}
