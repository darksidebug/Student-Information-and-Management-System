<?php 
if(session_status() === PHP_SESSION_NONE)
session_start();
$_SESSION['isLoggedIn'] = 0;

include './views/templates/header.php';
include './views/pages/login.php';
include './views/templates/footer.php';

?>

    

    