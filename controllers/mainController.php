<?php

//cargamos los modelos
require_once('models/userModel.php');
require_once('models/userRepository.php');
require_once('models/productModel.php');
require_once('models/productRepository.php');
require_once('models/orderLineModel.php');
require_once('models/orderLineRepository.php');
require_once('models/orderModel.php');
require_once('models/orderRepository.php');

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
} elseif (isset($_GET['basket'])) {
    require_once('controllers/basketController.php');
} elseif ($_SESSION['user']->role == 2) {
    $users=userRepository::getUsers(); //profesor lo hace null para comprobar que la funcion no devuelva null, aunque no es necesario
    $products=productRepository::getProducts();
    require_once('views/adminView.phtml');
} elseif ($_SESSION['user']->role == 1) {
    $products=productRepository::getProducts();
    $basketItems=orderLineRepository::getOrderLinesByOrderId('NULL'); 
    $basketTotal=0;
    foreach ($basketItems as $basketItem) {
        $basketTotal += $basketItem->getCost();

    }
    $orders=orderRepository::getOrdersByUserId($_SESSION['user']->id);
    require_once('views/mainView.phtml');
} else {
    $products=productRepository::getProducts();
    require_once('views/mainView.phtml');
}



?>