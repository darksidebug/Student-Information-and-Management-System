<?php

require_once '../database/DB_Query.php';  
require_once '../session/Flash.php';

$query = new DB_Queries(); 

if(isset($_POST['edit_student'])){
    $studentInfo = [
        'id'         => $_POST['info_id'],
        'student_id' => $_POST['studentID'],
        'lastname'   => $_POST['lastname'],
        'firstname'  => $_POST['firstname'],
        'middlename' => $_POST['middlename']
    ];

    $courseInfo = [
        'id'         => $_POST['course_id'],
        'student_id' => $_POST['studentID'],
        'yearlevel'  => $_POST['yearlevel'],
        'section'    => strtoupper($_POST['section']),
        'major'      => $_POST['major'],
        'a_y'        => $_POST['a_y'],
        'sem'        => $_POST['sem'],
    ];

    if(!$query->UpdateStudentInfo($studentInfo) || !$query->UpdateStudentCourse($courseInfo)){
        
        $flashKey = 'warning';
        $flashValue = 'Student and course information cannot be updated!';

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/views/pages/edit-student.php?info='.$_POST['info_id'].'&course='.$_POST['course_id']);
        return;
    }

    $flashKey = 'success';
    $flashValue = 'Student and course information successfully save!';
    if(!Session::SetFlashData($flashKey, $flashValue)){
        var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
        return;
    }

    header('Location: /SMIS_V1.0/views/pages/student-lists.php');
    return;
}

?>