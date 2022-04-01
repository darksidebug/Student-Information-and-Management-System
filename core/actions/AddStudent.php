<?php

require_once '../database/DB_Query.php';  
require_once '../session/Flash.php';

$query = new DB_Queries(); 

if(isset($_POST['add_student'])){

    $studentInfo = [
        'student_id' => $_POST['studentID'],
        'lastname'   => $_POST['lastname'],
        'firstname'  => $_POST['firstname'],
        'middlename' => $_POST['middlename']
    ];

    $courseInfo = [
        'student_id' => $_POST['studentID'],
        'yearlevel'  => $_POST['yearlevel'],
        'section'    => strtoupper($_POST['section']),
        'major'      => $_POST['major'],
        'a_y'        => $_POST['a_y'],
        'sem'        => $_POST['sem'],
    ];

    if($query->IsStudentIDTaken($_POST['studentID']) === TRUE){
        
        $flashKey = 'student_id';
        $flashValue = 'Student ID already taken, please create another one!';

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/views/pages/add-student.php');
        return;
    }

    if(!$query->AddStudent($studentInfo) || !$query->AddStudentToCourse($courseInfo)){
        
        $flashKey = 'warning';
        $flashValue = 'Student and course information cannot be save!';

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/views/pages/add-student.php');
        return;
    }

    $flashKey = 'success';
    $flashValue = 'Student and course information successfully save!';
    if(!Session::SetFlashData($flashKey, $flashValue)){
        var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
        return;
    }

    header('Location: /SMIS_V1.0/views/pages/add-student.php');
    return;
}

?>