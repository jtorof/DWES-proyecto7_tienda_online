<?php

class ProductRepository {
    //metodo para sacar todos los productos
	public static function getProducts(){
		$db=Conectar::conexion();
		$products= array();
		$result= $db->query("SELECT * FROM products WHERE hidden='0'");
		while($row=$result->fetch_assoc()){
				$products[]=new Product($row);
			}
		return $products;
	}
}

?>