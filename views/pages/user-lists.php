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

<?php 
    require_once '../../core/database/DB_Query.php'; 
    $query = new DB_Queries();
    $users = $query->GetUserList();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-dark">Users Lists</h4>
                <a class="btn btn-primary" href=""><i class="fas fa-plus"></i> Add User</a>
            </div>

            <?php if(isset($_SESSION['_flashdata'])): ?>
            <?php foreach($_SESSION['_flashdata'] as $key => $val): ?>
            <div class="alert alert-<?= ($key != "success" ? 'warning' : 'success') ?> mt-3 alert-dismissible fade show" role="alert">
                <?= ($key != "success" ? '<b>Warning! </b>' : '<b>Success! </b>') ?><?= Session::GetFlashData($key) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <td>User ID</td>
                            <td>Username</td>
                            <td>Password</td>
                            <td class="text-center">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)): ?>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?= $user["id"] ?></td>
                                <td><?= $user["username"] ?></td>
                                <td><?= $user["password"] ?></td>
                                <td class="text-center">
                                    <a class="btn btn-warning py-1" href=""><i class="fas fa-edit me-1"></i> Edit</a>
                                    <a class="btn btn-danger py-1 delete" id="<?= $user["id"] ?>"><i class="fas fa-trash-alt me-1"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-secondary">No record(s) found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.delete').forEach(btnDelete => {
        btnDelete.addEventListener('click', event => {
            if(confirm('Are you sure you want to delete this user?')){
                document.location.href = '../../core/actions/DeleteUser.php?identity='+ event.target.id
            }
        })
    })
</script>

<?php include '../templates/footer.php' ?>