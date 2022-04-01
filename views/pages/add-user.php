<?php include '../templates/header.php' ?>
<?php include '../templates/navbar.php' ?>
<?php require_once '../../core/session/Flash.php' ?>

<?php
    if(session_status() === PHP_SESSION_NONE)
    session_start();

    if($_SESSION['isLoggedIn'] === 0){
        header('Location: /SMIS_V1.0');
    }
?>

<form action="../../core/actions/AddUser.php" method="post">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">

            <?php if(isset($_SESSION['_flashdata'])): ?>
            <?php foreach($_SESSION['_flashdata'] as $key => $val): ?>
            <div class="alert alert-<?= ($key != "success" ? 'warning' : 'success') ?> alert-dismissible fade show" role="alert">
                <?= ($key != "success" ? '<b>Warning! </b>' : '<b>Success! </b>') ?><?= Session::GetFlashData($key) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center mt-2">User Credential</h5>
                    </div>
                    <div class="card-body px-4">
                        <table class="w-100 py-3">
                            <tr>
                                <td class="py-2">Username:</td>
                                <td class="py-2"><input type="text" name="username" class="form-control" placeholder="Enter username..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Password:</td>
                                <td class="py-2"><input type="password" name="password" class="form-control" placeholder="Enter password..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Confirm Password:</td>
                                <td class="py-2"><input type="password" name="cfm_pass" class="form-control" placeholder="Confirm password..." required></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div align="center">
                    <button class="btn btn-primary mt-3" name="add_user"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include '../templates/footer.php' ?>