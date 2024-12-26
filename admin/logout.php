<?php
    session_start();
    if(isset($_SESSION['admin_logged_in'])){
        session_unset();
        session_destroy();
        header("location: ../admin");
    }else{  
        header("location: /meha/admin");
    }
?>