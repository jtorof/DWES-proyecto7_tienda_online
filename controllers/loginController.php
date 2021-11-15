<?php
    //echo 'Llega al login controller';
    if(isset($_POST['loggingIn'])){
        if($u=userRepository::login($_POST['userName'], $_POST['password'])){
            $_SESSION['user']=$u;

            if($_SESSION['user']->role>0){
                header('location: index.php'); //redireccionar recargar pag manteniendo datos de sesion
            }
        } else {
            require_once('views/LoginView.phtml');
        }

    } elseif (isset($_GET['logout'])) {
        session_destroy();
        header('location: index.php');
    } else {
        require_once('views/loginView.phtml'); 
    }

?>