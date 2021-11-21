<?php

class OrderLineRepository {
    public static function getOrderLinesByOrderId($id) {
        $db=Conectar::conexion();
        $orderLines= array();
        if ($id=='NULL') {            
            $result= $db->query("SELECT * FROM orderlines WHERE orderid IS NULL AND userid='".$_SESSION['user']->id."'");
        } else {           
            $result= $db->query("SELECT * FROM orderlines WHERE orderid='".$id."' AND userid='".$_SESSION['user']->id."'");            
        }	
        if ($result) {
            while($row=$result->fetch_assoc()){
                $orderLines[]=new OrderLine($row);
            }
        }			
		return $orderLines;        
    }

    public static function addUnconfirmedOrderLine($p, $q) {
        $db=Conectar::conexion();      
        //comprobar si existe ya ese usuario?
        $exists=false;
        $orderLines=orderLineRepository::getOrderLinesByOrderId('NULL');
        //var_dump(count($orderLines) != 0);
        
        if (count($orderLines) != 0) {  
            //echo 'entra';          
            foreach ($orderLines as $orderLine) {
                if ($orderLine->productId == $p) {
                    //echo 'entra2';
                    $existingOrderLineId = $orderLine->id;
                    $exists = true;
                }
            }
        }
        if ($exists) {
            $db->query("UPDATE orderlines
            SET quantity=quantity + '".$q."'
            WHERE id='".$existingOrderLineId."' AND userid='".$_SESSION['user']->id."'");
        }
        if (!$exists) {            
            $db->query("INSERT INTO orderlines (productid, quantity, userid) 
            VALUES('".$p."', '".$q."', '".$_SESSION['user']->id."')");            
        }
        //$db->close();
    }

    public static function confirmOrderLines($orderId) {
        $db=Conectar::conexion();  
        $db->query("UPDATE orderlines
            SET orderid='".$orderId."'
            WHERE orderid IS NULL AND userid='".$_SESSION['user']->id."'");  
        $products=productRepository::getProducts();
        $orderLines=orderLineRepository::getOrderLinesByOrderId($orderId);       
        
        foreach ($products as $product) {
            //echo 'llega1';
            foreach ($orderLines as $orderLine) {
                //echo 'llega2';
                //var_dump($product->id);
                //var_dump($orderLine->productId);

                if ($product->id == $orderLine->productId) {
                    /* echo 'llega3';
                    var_dump($product->id);
                    var_dump($orderLine->quantity); */
                    productRepository::adjustStock($product->id, $orderLine->quantity);
                }
            }
        }
        //die();
    }
}

?>