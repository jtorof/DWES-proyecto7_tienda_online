<?php

class OrderLineRepository {
    public static function getOrderLinesByOrderId($id) {
        echo 'get1';
        $db=Conectar::conexion();
        $orderLines= array();
		$result= $db->query("SELECT * FROM products WHERE orderid='".$id."'");
        var_dump($result);
        if ($result) {
            while($row=$result->fetch_assoc()){
				$orderLines[]=new OrderLine($row);
			}
        }		
        var_dump($orderLines);
		return $orderLines;
        
    }

    public static function addUnconfirmedOrderLine($p, $q) {
        echo 'hola2';
        $db=Conectar::conexion();      
        //comprobar si existe ya ese usuario?
        $exists=false;
        $orderLines=orderLineRepository::getOrderLinesByOrderId('NULL');
        if (count($orderLines) != 0) {
            echo 'if';
            foreach ($orderLines as $orderLine) {
                if ($orderLine->productid == $p) {
                    $exists = true;
                }
            }
        }
        
        if (!$exists) {
            echo 'antes de insertar';
            echo "INSERT INTO orderlines (productid, quantity) 
            VALUES('".$p."', '".$q."')";
            $result = $db->query("INSERT INTO orderlines (productid, quantity) 
            VALUES('".$p."', '".$q."')");
            
        }
        $db->close();
    }
}

?>