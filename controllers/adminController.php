<?php
    if(isset($_GET['makeAdmin'])) {
        userRepository::changeRole($_GET['makeAdmin'], 2);
    }
    if(isset($_GET['makeBase'])) {
        userRepository::changeRole($_GET['makeBase'], 1);
    }
    if(isset($_GET['editUser'])) {
        if ($user=userRepository::getUserById($_GET['editUser'])){
            require_once('views/editUserView.phtml');
            die();
        }
    }
    if(isset($_GET['saveUser'])) {
        if (isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['email'])) {
            $test=userRepository::changeData($_GET['saveUser'], $_POST['fullname'], $_POST['username'], $_POST['email']);             //me hace falta pero no sé por qué
        }        
    }
    if(isset($_GET['deleteUser'])) {
        userRepository::deleteUser($_GET['deleteUser']);
    }

    /* if(isset($_GET['deleteProduct'])) {
        //userRepository::deleteUser($_GET['delete']);
    } */
    if(isset($_GET['addProduct'])) {
        require_once('views/addProductView.phtml');
        die();
    }
    if(isset($_GET['addingProduct'])) {
        if (isset($_POST['productName']) && isset($_POST['productDescription']) && isset($_POST['productPrice']) && isset($_POST['productStock'])) {
            productRepository::addProduct($_POST['productName'], $_POST['productDescription'], $_POST['productPrice'], $_POST['productStock']);
        }
    }
    header('location: index.php');

    

?>