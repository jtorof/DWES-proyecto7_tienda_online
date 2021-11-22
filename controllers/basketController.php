<?php

if (isset($_POST['addingProductToBasket'])) {
    if (isset($_POST['productId']) && isset($_POST['quantity'])) {
        if ($_POST['quantity']>0) {
            orderLineRepository::addUnconfirmedOrderLine($_POST['productId'], $_POST['quantity']);             //me hace falta pero no sé por qué     
        }
           
    }        
}
if (isset($_GET['checkout'])) {
    //orderLineRepository::confirmOrderLines(OrderRepository::makeOrder($_GET['checkout']));    
    orderRepository::makeOrder();    
}

header('location: index.php');


?>