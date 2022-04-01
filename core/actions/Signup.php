<?php

$sql = "INSERT INTO users ('username', 'password') VALUES ('benj', ".MD5('darksidebug').")";
$result = mysqli_query($this->CONN, $sql);  

?>