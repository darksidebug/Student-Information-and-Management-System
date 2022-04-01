<?php

require_once '../database/DB_Query.php';  
require_once '../session/Flash.php';

$query = new DB_Queries();

if((!isset($_GET['info']) || !isset($_GET['student-id'])) || (empty($_GET['info']) || empty($_GET['student-id']))){
    header('Location: /SMIS_V1.0/views/pages/student-lists.php');
    return;
}

if(!$query->DeleteStudentInfo($_GET['info']) || !$query->DeleteStudentCourse($_GET['student-id'])){
    $flashKey = 'warning';
    $flashValue = 'Student and course information cannot be deleted!';

    if(!Session::SetFlashData($flashKey, $flashValue)){
        var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
        return;
    }

    header('Location: /SMIS_V1.0/views/pages/student-lists.php');
    return;
}

$flashKey = 'success';
$flashValue = 'Student and course information successfully deleted!';
if(!Session::SetFlashData($flashKey, $flashValue)){
    var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
    return;
}

header('Location: /SMIS_V1.0/views/pages/student-lists.php');
return;

?>