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
    $students = isset($_GET['keyword']) ? $query->GetStudentByKeyword($_GET['keyword']) : $query->GetStudentList();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-dark">Students Lists</h4>
                <a class="btn btn-primary" href="add-student.php"><i class="fas fa-plus"></i> Add Student</a>
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
                            <td>Student ID</td>
                            <td>Lastname</td>
                            <td>Firstname</td>
                            <td>Middlename</td>
                            <td>Year&Section</td>
                            <td>Major</td>
                            <td>Semester</td>
                            <td>A.Y</td>
                            <td class="text-center">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($students)): ?>
                        <?php foreach($students as $student): ?>
                            <tr>
                                <td><?= $student["student_id"] ?></td>
                                <td><?= $student["lname"] ?></td>
                                <td><?= $student["fname"] ?></td>
                                <td><?= $student["mname"] ?></td>
                                <td><?= $student["yearlevel"].'-'.$student["section"] ?></td>
                                <td><?= $student["major"] ?></td>
                                <td><?= $student["sem"] ?></td>
                                <td><?= $student["a_y"] ?></td>
                                <td class="text-center">
                                    <a class="btn btn-warning py-1" 
                                        href="edit-student.php?info=<?= $student[0] ?>&course=<?= $student['id'] ?>">
                                        <i class="fas fa-edit me-1"></i> Edit</a>
                                    <a class="btn btn-danger py-1 delete" id="info=<?= $student[0] ?>&student-id=<?= $student['student_id'] ?>">
                                        <i class="fas fa-trash-alt me-1"></i> Delete</a>
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
            if(confirm('Are you sure you want to delete this record? This will delete all the data associated with this record.')){
                document.location.href = '../../core/actions/DeleteStudent.php?'+ event.target.id
            }
        })
    })
</script>

<?php include '../templates/footer.php' ?>