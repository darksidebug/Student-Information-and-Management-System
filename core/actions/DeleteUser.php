<?php

require_once '../database/DB_Query.php';  
require_once '../session/Flash.php';

$query = new DB_Queries();

if(!isset($_GET['identity']) || empty($_GET['identity'])){
    header('Location: /SMIS_V1.0/views/pages/user-lists.php');
    return;
}

if(!$query->DeleteUser($_GET['identity'])){
    $flashKey = 'warning';
    $flashValue = 'User credential cannot be deleted!';

    if(!Session::SetFlashData($flashKey, $flashValue)){
        var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
        return;
    }

    header('Location: /SMIS_V1.0/views/pages/user-lists.php');
    return;
}

$flashKey = 'success';
$flashValue = 'User credential successfully deleted!';
if(!Session::SetFlashData($flashKey, $flashValue)){
    var_dump(['flash key' => $flashKey, 'flash value' => $flashValue, 'message' => 'Flash key or value cannot be empty or null!']);
    return;
}

header('Location: /SMIS_V1.0/views/pages/user-lists.php');
return;

?>