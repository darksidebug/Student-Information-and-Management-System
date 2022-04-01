<?php include '../templates/header.php' ?>
<?php include '../templates/navbar.php' ?>

<?php 
    if(session_status() === PHP_SESSION_NONE)
    session_start();

    if($_SESSION['isLoggedIn'] === 0){
        header('Location: /SMIS_V1.0');
    }

    require_once '../../core/database/DB_Query.php'; 
    $query = new DB_Queries();
?>

<div class="container mt-5">
    <div class="row">
        <h1 class="text-center mt-3" id="date"></h1>
        <h2 class="text-center" id="time"></h2>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-7">
            <hr>
            <div class="row my-4">
                <div class="col-md-6 my-1">
                    <div class="card bg-warning p-3">
                        <h5 class="text-white">Total No. of Students</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-2"><i class="fas fa-graduation-cap"></i></h4>
                            <h4 class="text-white mt-3"><b>
                                <?= $query->GetTotalStudents() ?>
                            </b></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="card bg-info p-3">
                        <h5 class="text-white">Total No. of Users</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-2"><i class="fas fa-users"></i></h4>
                            <h4 class="text-white mt-3"><b>
                                <?= $query->GetTotalUsers() ?>
                            </b></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="card bg-danger p-3">
                        <h5 class="text-white">Programming Students</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-2"><i class="fas fa-code"></i></h4>
                            <h4 class="text-white mt-3"><b>
                                <?= $query->GetTotalStudentsByMajor('BSIT-Programming') ?>
                            </b></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-1">
                    <div class="card bg-secondary p-3">
                        <h5 class="text-white">Networking Students</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-2"><i class="fas fa-network-wired"></i></h4>
                            <h4 class="text-white mt-3"><b>
                                <?= $query->GetTotalStudentsByMajor('BSIT-Networking') ?>
                            </b></h4>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-12" align="center">
                    <a class="btn btn-primary" href="add-student.php"><i class="fas fa-plus"></i> Add Student</a>
                    <a class="btn btn-secondary" href="add-user.php"><i class="fas fa-user-plus"></i> Add User</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    startTime()
    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML =  h + ":" + m + ":" + s;
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    var date =  new Date()
    var newDate = date.toDateString().split(' '),
        cleanDate = date.toLocaleString('default', { month: 'long' }) + ' ' + newDate[2] + ', ' + newDate[3]

    document.getElementById('date').innerHTML = cleanDate
</script>

<?php include '../templates/footer.php' ?>