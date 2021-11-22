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
        //cambiar a consulta multitabla?
        foreach ($products as $product) {
            foreach ($orderLines as $orderLine) {
                if ($product->id == $orderLine->productId) {
                    $allOK=productRepository::checkStock($product->id, $orderLine->quantity);
                    if (!$allOK) {
                        //echo 'no suficiente stock';
                        //die();
                        //return error
                        return null;
                    }         
                }
            }
        }
        if ($allOK) {
            foreach ($products as $product) {
                foreach ($orderLines as $orderLine) {
                    if ($product->id == $orderLine->productId) {      
                        productRepository::adjustStock($product->id, $orderLine->quantity);           
                    }
                }
            }
        }
        //die();
        return $orderLines;
    }

    /* public static function confirmOrderLines($orderId) {
        $db=Conectar::conexion();  
        $db->query("UPDATE orderlines
            SET orderid='".$orderId."'
            WHERE orderid IS NULL AND userid='".$_SESSION['user']->id."'");  
        $products=productRepository::getProducts();
        $orderLines=orderLineRepository::getOrderLinesByOrderId($orderId);       
        
        foreach ($products as $product) {
            foreach ($orderLines as $orderLine) {
                if ($product->id == $orderLine->productId) {
                    productRepository::adjustStock($product->id, $orderLine->quantity);
                }
            }
        }
    } */
}

?>