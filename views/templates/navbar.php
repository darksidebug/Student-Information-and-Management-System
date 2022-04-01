<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <a class="navbar-brand pt-0" href="#">SMIS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse pt-0 ms-md-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-2">
                    <a class="nav-link active" aria-current="page" href="../pages/home.php"><i class="fas fa-home me-1"></i> Home</a>
                </li>
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-graduation-cap me-1"></i> Students
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../pages/add-student.php"><i class="fas fa-plus me-1"></i> Add new</a></li>
                        <li><a class="dropdown-item" href="../pages/student-lists.php"><i class="fas fa-search me-1"></i> View Lists</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i> System User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../pages/add-user.php"><i class="fas fa-plus me-1"></i> Add new</a></li>
                        <li><a class="dropdown-item" href="../pages/user-lists.php"><i class="fas fa-search me-1"></i> View Lists</a></li>
                        <li><a class="dropdown-item" href="../../core/actions/Logout.php"><i class="fas fa-right-from-bracket me-1"></i> Sign-out</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" method="get" action="../../core/actions/Students.php">
                <input type="hidden" name="uri" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <input class="form-control me-2" name="keyword" placeholder="Search" aria-label="Search">
                <button class="btn btn-success d-flex justify-content-between align-items-center" type="submit"><i class="fas fa-search me-2"></i> Search</button>
            </form>
        </div>
    </div>
</nav>