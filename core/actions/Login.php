<?php

require_once '../database/DB_Query.php';  
require_once '../session/flash.php';
    
$query = new DB_Queries(); 

if(isset($_POST['login'])){

    $username = $_POST['username'];  
    $password = $_POST['password']; 

    $flashKey = empty($username) ? 'username' : (empty($password) ? 'password' : 'u_pass');

    if(empty($username) || empty($password)){
        
        $flashValue = $flashKey == 'username' ? 'Username is required!' : ($flashKey == 'password' ? 'Password is required!' : 'Username or password is required!');

        if(!Session::SetFlashData($flashKey, $flashValue)){
            var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
            return;
        }

        header('Location: /SMIS_V1.0/');
        return;
    }

    if($query->Login($username, $password) === FALSE){

        Session::SetFlashData('user', 'Invalid credentials. User does not exists!');
        header('Location: /SMIS_V1.0/');
        return;
    }

    $_SESSION['isLoggedIn'] = 1;
    header('Location: /SMIS_V1.0/views/pages/home.php');
    exit();
}

