<?php

if(isset($_POST['addingProductToBasket'])) {
    if (isset($_POST['productId']) && isset($_POST['quantity'])) {
        echo 'hola';
        var_dump($_POST['productId']);
        var_dump($_POST['quantity']);
        orderLineRepository::addUnconfirmedOrderLine($_POST['productId'], $_POST['quantity']);             //me hace falta pero no sé por qué
    }        
}


?>