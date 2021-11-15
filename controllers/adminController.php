<?php
    if(isset($_GET['makeAdmin'])) {
        userRepository::changeRole($_GET['makeAdmin'], 2);
    }
    if(isset($_GET['makeBase'])) {
        userRepository::changeRole($_GET['makeBase'], 1);
    }
    if(isset($_GET['editUser'])) {
        if ($user=userRepository::getUserById($_GET['edit'])){
            require_once('views/editUserView.phtml');
            die();
        }
    }
    if(isset($_GET['saveUser'])) {
        if (isset($_POST['fullname'])) {
            $test=userRepository::changeData($_GET['save'], $_POST['fullname'], $_POST['username'], $_POST['email']);
        }        
    }
    if(isset($_GET['deleteUser'])) {
        userRepository::deleteUser($_GET['delete']);
    }

    if(isset($_GET['deleteProduct'])) {
        //userRepository::deleteUser($_GET['delete']);
    }
    if(isset($_GET['addProduct'])) {
        //userRepository::deleteUser($_GET['delete']);
    }
    

?>