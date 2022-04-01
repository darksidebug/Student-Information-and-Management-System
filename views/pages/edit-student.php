<?php include '../templates/header.php' ?>
<?php include '../templates/navbar.php' ?>
<?php require_once '../../core/session/Flash.php' ?>
<?php require_once '../../core/actions/Helper.php' ?>

<?php
    if((!isset($_GET['info']) || !isset($_GET['course'])) || (empty($_GET['info']) || empty($_GET['course']))){
        header('Location: /SMIS_V1.0/views/pages/student-lists.php');
    }
?>

<?php 
    require_once '../../core/database/DB_Query.php'; 
    $query = new DB_Queries();
    $infos = $query->GetStudentByID($_GET['info'], $_GET['course']);
?>

<form action="../../core/actions/EditStudent.php" method="post">
    <input type="hidden" name="info_id" value="<?= $_GET['info'] ?>">
    <input type="hidden" name="course_id" value="<?= $_GET['course'] ?>">
    <div class="container mt-5">
        <h3 class="text-center mb-4">Update Student Informations</h3>

        <?php if(isset($_SESSION['_flashdata'])): ?>
        <?php foreach($_SESSION['_flashdata'] as $key => $val): ?>
        <div class="alert alert-<?= ($key != "success" ? 'warning' : 'success') ?> alert-dismissible fade show" role="alert">
            <?= ($key != "success" ? '<b>Warning! </b>' : '<b>Success! </b>') ?><?= Session::GetFlashData($key) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
        <?php foreach($infos as $info): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card px-3">
                    <div class="card-body">
                        <h5 class="text-center">Personal Information</h5>
                        <table class="w-100 mt-4">
                            <tr>
                                <td class="py-2">Student ID:</td>
                                <td class="py-2">
                                    <input type="text" name="studentID" class="form-control" placeholder="Enter student ID..." value="<?= $info['student_id'] ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Lastname:</td>
                                <td class="py-2">
                                    <input type="text" name="lastname" class="form-control" placeholder="Enter last name..." value="<?= $info['lname'] ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Firstname:</td>
                                <td class="py-2">
                                    <input type="text" name="firstname" class="form-control" placeholder="Enter first name..." value="<?= $info['fname'] ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Middlename:</td>
                                <td class="py-2">
                                    <input type="text" name="middlename" class="form-control" placeholder="Enter middle name..." value="<?= $info['mname'] ?>" required>
                                </td>
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
                                        <option value="1" <?= Helper::OptionSelected(1, $info['yearlevel']) ?> >1</option>
                                        <option value="2" <?= Helper::OptionSelected(2, $info['yearlevel']) ?> >2</option>
                                        <option value="3" <?= Helper::OptionSelected(3, $info['yearlevel']) ?> >3</option>
                                        <option value="4" <?= Helper::OptionSelected(4, $info['yearlevel']) ?> >4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Section:</td>
                                <td class="py-2">
                                    <input type="text" name="section" class="form-control" placeholder="Enter section..." value="<?= $info['section'] ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Major:</td>
                                <td class="py-2">
                                    <select type="text" name="major" class="form-select" required>
                                        <option value="" class="text-muted">Select major...</option>
                                        <option value="BSIT-Programming" <?= Helper::OptionSelected("BSIT-Programming", $info['major']) ?> >BSIT-Programming</option>
                                        <option value="BSIT-Networking" <?= Helper::OptionSelected("BSIT-Networking", $info['major']) ?> >BSIT-Networking</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">School Year:</td>
                                <td class="py-2">
                                    <input type="text" name="a_y" class="form-control" placeholder="Enter school year..." value="<?= $info['a_y'] ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2">Semester:</td>
                                <td class="py-2">
                                    <select type="text" name="sem" class="form-select" required>
                                        <option value="" class="text-muted">Select semester...</option>
                                        <option value="Sem-1" <?= Helper::OptionSelected("Sem-1", $info['sem']) ?> >Sem-1</option>
                                        <option value="Sem-2" <?= Helper::OptionSelected("Sem-2", $info['sem']) ?> >Sem-2</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" name="edit_student"><i class="fas fa-paper-plane"></i> Update</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</form>

<?php include '../templates/footer.php' ?>