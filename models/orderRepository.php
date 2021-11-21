<?php

class OrderRepository {

    public static function getOrdersByUserId($userId) {
        $db=Conectar::conexion();
		$orders= array();
		$result= $db->query("SELECT * FROM orders WHERE customerid='".$userId."'");
        //$result= $db->query("SELECT * FROM users");
		while($row=$result->fetch_assoc()){
				$orders[]=new Order($row);
			}
		return $orders;
    }

    public static function makeOrder($basketTotal) {
        $db=Conectar::conexion();
        $result=$db->query("INSERT INTO orders (customerid, totalcost, status) 
        VALUES('".$_SESSION['user']->id."', '".$basketTotal."', 'creada')"); 
        if($result) {
            return $id=$db->insert_id;
        }
    }

}

?>