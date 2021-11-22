<?php

class OrderRepository {

    public static function getAllOrders() {
        $db=Conectar::conexion();
		$orders= array();
		$result= $db->query("SELECT * FROM orders");
		while($row=$result->fetch_assoc()){
				$orders[]=new Order($row);
			}
		return $orders;
    }

    public static function getOrdersByUserId($userId) {
        $db=Conectar::conexion();
		$orders= array();
		$result= $db->query("SELECT * FROM orders WHERE customerid='".$userId."' AND status='confirmado'");
        
		while($row=$result->fetch_assoc()){
				$orders[]=new Order($row);
			}
		return $orders;
    }

    public static function makeOrder() {
        $db=Conectar::conexion();
        
        $result=$db->query("INSERT INTO orders (customerid, status) 
        VALUES('".$_SESSION['user']->id."', 'creado')"); 
        if($result) {
            $id=$db->insert_id;
        }
        $confirmedOrderLines=orderLineRepository::confirmOrderLines($id);
        if (is_null($confirmedOrderLines)) {            
            $result2=$db->query("UPDATE orders
                SET status='stock insuficiente'
                WHERE id='".$id."'
                ");
            
            $db->query("UPDATE orderlines
            SET orderid=NULL
            WHERE orderid='".$id."' AND userid='".$_SESSION['user']->id."'");  
            return;
        }
        $totalCost=0;
        foreach ($confirmedOrderLines as $confirmedOrderLine) {
            $totalCost += $confirmedOrderLine->getCost();
        }
        $result3=$db->query("UPDATE orders
        SET totalcost='".$totalCost."'
        WHERE id='".$id."'
        ");
        if($result3) {
            $db->query("UPDATE orders
                SET status='confirmado'
                WHERE id='".$id."'
                ");
        }
    }

}

?>