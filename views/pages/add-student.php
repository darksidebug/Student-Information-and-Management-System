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

<form action="../../core/actions/AddStudent.php" method="post">
    <div class="container mt-5">

        <?php if(isset($_SESSION['_flashdata'])): ?>
        <?php foreach($_SESSION['_flashdata'] as $key => $val): ?>
        <div class="alert alert-<?= ($key != "success" ? 'warning' : 'success') ?> alert-dismissible fade show" role="alert">
            <?= ($key != "success" ? '<b>Warning! </b>' : '<b>Success! </b>') ?><?= Session::GetFlashData($key) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card px-3">
                    <div class="card-body">
                        <h5 class="text-center">Personal Information</h5>
                        <table class="w-100 mt-4">
                            <tr>
                                <td class="py-2">Student ID:</td>
                                <td class="py-2"><input type="text" name="studentID" class="form-control" placeholder="Enter student ID..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Lastname:</td>
                                <td class="py-2"><input type="text" name="lastname" class="form-control" placeholder="Enter last name..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Firstname:</td>
                                <td class="py-2"><input type="text" name="firstname" class="form-control" placeholder="Enter first name..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Middlename:</td>
                                <td class="py-2"><input type="text" name="middlename" class="form-control" placeholder="Enter middle name..." required></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card px-3">
                    <div class="card-body">
                        <h5 class="text-center">Course Information</h5>
                        <table class="w-100 mt-4">
                            <tr>
                                <td class="py-2">Year Level:</td>
                                <td class="py-2">
                                    <select type="text" name="yearlevel" class="form-select" required>
                                        <option value="" class="text-muted">Select year level...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Section:</td>
                                <td class="py-2"><input type="text" name="section" class="form-control" placeholder="Enter section..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Major:</td>
                                <td class="py-2">
                                    <select type="text" name="major" class="form-select" required>
                                        <option value="" class="text-muted">Select major...</option>
                                        <option value="BSIT-Programming">BSIT-Programming</option>
                                        <option value="BSIT-Networking">BSIT-Networking</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">School Year:</td>
                                <td class="py-2"><input type="text" name="a_y" class="form-control" placeholder="Enter school year..." required></td>
                            </tr>
                            <tr>
                                <td class="py-2">Semester:</td>
                                <td class="py-2">
                                    <select type="text" name="sem" class="form-select" required>
                                        <option value="" class="text-muted">Select semester...</option>
                                        <option value="Sem-1">Sem-1</option>
                                        <option value="Sem-2">Sem-2</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" name="add_student"><i class="fas fa-paper-plane"></i> Submit</button>
            </div>
        </div>
    </div>
</form>

<?php include '../templates/footer.php' ?>