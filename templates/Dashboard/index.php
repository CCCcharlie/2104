<!-- src/Templates/Dashboard/index.php -->
<head>
    ...
    <?= $this->Html->css('sidebar') ?>
    ...
</head>
<div class="container-fluid">
    <div class="row">
        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- templates/Organisations/public_facing.php -->
            <h1>About Nathan's Business</h1>
            <p>Nathan’s business specialises in B2B projects. We collaborate with business partners and contractors to deliver exceptional results. Join us to make an impact together!</p>
            <h3>Register as a Business Partner or Contractor</h3>
            <p>Interested in partnering with us? Please register below:</p>

            <ul>
                <li><?= $this->Html->link(__('Register as a Contractor'), ['controller' => 'Contractors', 'action' => 'add'], ['class' => 'button btn btn-primary']) ?></li>
                <li><?= $this->Html->link(__('Register as an Organisation'), ['controller' => 'Organisations', 'action' => 'add'], ['class' => 'button btn btn-primary']) ?></li>
                <li><?= $this->Html->link(__('Contact Us'), ['controller' => 'Contact', 'action' => 'add'], ['class' => 'button btn btn-primary']) ?></li>

            </ul>
        </main>
    </div>
</div>

