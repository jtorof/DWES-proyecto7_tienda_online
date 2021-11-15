<?php

if(isset($_POST['registeringIn'])){
    if($_POST['password'] == $_POST['password2'] && !empty($_POST['password'])) {  
        userRepository::register($_POST['fullname'], $_POST['username'], $_POST['password'], $_POST['email']);
        header('location: index.php');
    } else {
        //posible mensaje de error por problemas con la contraseña
        require_once('views/registerView.phtml');
    }     
} else {
    require_once('views/registerView.phtml');
}
?>