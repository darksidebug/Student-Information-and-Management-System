<?php

if(!empty($_GET['keyword'])){
    header('Location: /SMIS_V1.0/views/pages/student-lists.php?keyword='.$_GET['keyword']);
}
else{
    header('Location: '.$_GET['uri']);
}

?>