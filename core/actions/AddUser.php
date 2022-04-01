<?php

require_once '../database/DB_Query.php';  
require_once '../session/flash.php';

$query = new DB_Queries(); 

if(isset($_POST['add_user'])){

    if($_POST['password'] !== $_POST['cfm_pass']){

        $flashKey = 'password';
        $flashValue = 'Password did not matched!';

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/views/pages/add-user.php');
        return;
    }

    if($query->IsUsernameTaken($_POST['username']) === TRUE){
        
        $flashKey = 'username';
        $flashValue = 'Username already taken, please create another one!';

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/views/pages/add-user.php');
        return;
    }

    if(!$query->AddUser($_POST['username'], $_POST['password'])){

        $flashKey = 'warning';
        $flashValue = 'User credential cannot be save!';

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/views/pages/add-user.php');
        return;
    }

    $flashKey = 'success';
    $flashValue = 'User credential successfully save!';
    if(!Session::SetFlashData($flashKey, $flashValue)){
        var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
        return;
    }

    header('Location: /SMIS_V1.0/views/pages/add-user.php');
    return;
}

?>