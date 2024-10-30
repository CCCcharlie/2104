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
$loggedIn = $this->request->getAttribute('identity') !== null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $cakeDescription ?> - <?= $this->fetch('title') ?></title>

    <!-- Bootstrap 4 Admin Theme CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <?= $this->Html->css(['sb-admin-2.min', 'sidebar', 'normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $this->Url->build('/dashboard'); ?>">
            <div class="sidebar-brand-icon">
                <?= $this->Html->image('logo.png', ['alt' => 'Nathan\'s Business Logo', 'class' => 'logo', 'style' => 'height: 70px; width: auto;']) ?>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/dashboard'); ?>"><i class="fas fa-project-diagram"></i> Dashboard</a></li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Conditional Links based on login status -->
        <?php if ($loggedIn): ?>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/projects'); ?>"><i class="fas fa-project-diagram"></i> Projects</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/contractors'); ?>"><i class="fas fa-users"></i> Contractors</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/organisations'); ?>"><i class="fas fa-building"></i> Organisations</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/contact'); ?>"><i class="fas fa-envelope"></i> Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/skills'); ?>"><i class="fas fa-tools"></i> Skills</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/users/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/contractors/add'); ?>"><i class="fas fa-user-plus"></i> Register Contractor</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/organisations/add'); ?>"><i class="fas fa-plus-circle"></i> Register Organisation</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/contact/add'); ?>"><i class="fas fa-envelope"></i> Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build('/users/login'); ?>"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        <?php endif; ?>
    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <h1 class="h3 mb-0 text-gray-800"><?= $this->fetch('title') ?></h1>
            </nav>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>

