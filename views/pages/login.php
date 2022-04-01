<?php require_once './core/session/Flash.php' ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <h3 class="text-center text-secondary">Student Management and Information System</h3>
        <div class="col-md-6 col-lg-4 mt-3">

            <?php if(isset($_SESSION['_flashdata'])): ?>
            <?php foreach($_SESSION['_flashdata'] as $key => $val): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= Session::GetFlashData($key) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

            <div class="card mt-3">
                <div class="card-header text-center text-secondary pt-3">
                    <h5>USER LOGIN</h5>
                </div>
                <div class="card-body">
                    <form action="./core/actions/login.php" method="post" class="my-3">
                        <div class="form-group">
                            <label class="text-secondary" for="">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                        </div>
                        <div class="form-group mt-1">
                            <label class="text-secondary" for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                        </div>
                        <div class="mt-3" align="center">
                            <button class="btn btn-primary" name="login" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>