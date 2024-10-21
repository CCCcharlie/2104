<!-- src/Templates/Dashboard/index.php -->

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li><a href="<?= $this->Url->build('./dashboard'); ?>">Dashboard</a></li>
                    <li><a href="<?= $this->Url->build('./projects'); ?>">Projects</a></li>
                    <li><a href="<?= $this->Url->build('./contractors'); ?>">Contractors</a></li>
                    <li><a href="<?= $this->Url->build('./organisations'); ?>">Organisations</a></li>
                    <li><a href="<?= $this->Url->build('./contact-us'); ?>">Contact Us</a></li>
                </ul>
            </div>
        </nav>
        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
            </div>
            <!-- Cards section -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">1500</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Projects</h5>
                            <p class="card-text">240</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pending Tasks</h5>
                            <p class="card-text">12</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table section -->
            <h2>Recent Projects</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Team Members</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Website Redesign</td>
                        <td>In Progress</td>
                        <td>Oct 15, 2024</td>
                        <td>John, Sarah</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Marketing Plan</td>
                        <td>Completed</td>
                        <td>Sept 30, 2024</td>
                        <td>Mike, Alice</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

