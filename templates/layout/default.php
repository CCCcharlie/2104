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
<html>
<head>

    <!-- src/Templates/Layout/default.php -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon', '/favicon.ico', ['type' => 'image/x-icon']); ?>
    <?= $this->Html->css(['sidebar']) ?>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <!-- Display the logo with a link to the homepage -->
            <?= $this->Html->link(
                $this->Html->image('logo.png', ['alt' => 'Nathan\'s Business Logo', 'class' => 'logo', 'style' => 'height: 70px; width: auto;']),
                ['controller' => 'Pages', 'action' => 'display', 'home'],
                ['escape' => false]
            ) ?>
        </div>

        <div class="top-nav-links">
            <?php if ($loggedIn): ?>
                <a href="<?= $this->Url->build('./dashboard'); ?>">Homepage</a>
                <a href="<?= $this->Url->build('./projects'); ?>">Projects</a>
                <a href="<?= $this->Url->build('./contractors'); ?>">Contractors</a>
                <a href="<?= $this->Url->build('./organisations'); ?>">Organisations</a>
                <a href="<?= $this->Url->build('./contact'); ?>">Contact Us</a>
                <a href="<?= $this->Url->build('./skills'); ?>">Skills</a>
                <a><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?></a>
            <?php else: ?>
                <!-- Public Navigation for Unauthenticated Users -->
                <a href="<?= $this->Url->build('./dashboard'); ?>">Homepage</a>
                <a href="<?= $this->Url->build('./contractors/add'); ?>">Register Contractor</a>
                <a href="<?= $this->Url->build('./organisations/add'); ?>">Register Organisation</a>
                <a href="<?= $this->Url->build('./contact/add'); ?>">Contact Us</a>
                <a><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></a>
            <?php endif; ?>
        </div>


    </nav>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
