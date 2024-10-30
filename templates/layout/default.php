<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<?php
// Check if the user is logged in
$loggedIn = $this->request->getAttribute('identity') !== null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $cakeDescription ?> - <?= $this->fetch('title') ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- FontAwesome icons -->

    <!-- Custom CSS for SB Admin 2 and additional CSS files -->
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->Html->css(['all.min.css', 'sb-admin-2.min.css', 'sidebar.css']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>




</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $this->Url->build('/') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Nathan Admin pages</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Items -->
        <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build('/dashboard') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build('/projects') ?>">
                <i class="fas fa-fw fa-folder"></i>
                <span>Projects</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build('/contractors') ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Contractors</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build('/organisations') ?>">
                <i class="fas fa-fw fa-building"></i>
                <span>Organisations</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build('/contact') ?>">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Contact Us</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= $this->Url->build('/skills') ?>">
                <i class="fas fa-fw fa-tools"></i>
                <span>Skills</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <?php if ($loggedIn): ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        Welcome, <?= h($this->request->getAttribute('identity')->first_name) ?>
                                    </span>
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <div class="nav-item dropdown no-arrow"
                                 aria-labelledby="userDropdown">
                                <?= $this->Html->link(
                                    'Logout',
                                    ['controller' => 'Users', 'action' => 'logout'],
                                    ['class' => 'dropdown-item']
                                ) ?>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
                        </li>
                    <?php endif; ?>
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; My Application 2024</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<?= $this->Html->script(['vendor/jquery/jquery.min', 'vendor/bootstrap/js/bootstrap.bundle.min']) ?>
<!-- Custom scripts for all pages-->
<?= $this->Html->script('sb-admin-2.min') ?>
</body>

</html>
