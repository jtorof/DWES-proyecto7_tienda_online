<?php

//cargamos los modelos
require_once('models/userModel.php');
require_once('models/userRepository.php');
require_once('models/productModel.php');
require_once('models/productRepository.php');

session_start();

if(!isset($_SESSION['user'])) {    
    $datos['id'] = 0;
    $datos['username'] = "";    
    $datos['fullname'] = "";
    $datos['email'] = "";
    $datos['role'] = 0;
    $_SESSION['user'] = new User($datos);
}

if (isset($_GET['login'])) {
    require_once('controllers/loginController.php');
    //die(); lo quito y no pasa nada
} elseif (isset($_GET['register'])) {
    require_once('controllers/registerController.php');        
    //die(); lo quito y no pasa nada
} elseif (isset($_GET['admin'])) {
    require_once('controllers/adminController.php');
} elseif (isset($_GET['basicUser'])) {
    //require_once('controllers/basicUserController.php');
} elseif ($_SESSION['user']->role == 2) {
    $users=userRepository::getUsers(); //profesor lo hace null para comprobar que la funcion no devuelva null, aunque no es necesario
    $products=productRepository::getProducts();
    require_once('views/adminView.phtml');
} elseif ($_SESSION['user']->role == 1) {
    $users=userRepository::getUsers();
    //$friends=friendRepository::getFriends();
    //require_once('views/basicUserView.phtml');
} else {
    require_once('views/mainView.phtml');
}



?>