<?php

    session_start();

    if(isset($_SESSION['user'])){

        if($_SESSION['user'] == null){
            $_SESSION['messageAuth'] = "Debes iniciar session vacano";
            header("location: ../index.php");
            exit();
        }

    }else{
        $_SESSION['messageAuth'] = "Debes iniciar session vacano";
        header("location: ../index.php");
        exit();
    }

?>