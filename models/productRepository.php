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

	public static function addProduct ($n, $d, $p, $s) {
        $db=Conectar::conexion();      
        //comprobar si existe ya ese usuario?
        $exists=false;
        $products=productRepository::getProducts();
        foreach ($products as $product) {
            if ($product->name == $n) {
                $exists = true;
            }
        }
        if (!$exists) {
            $result = $db->query("INSERT INTO products (name, description, price, stock) 
            VALUES('".$n."', '".$d."', '".$p."', '".$s."')");
        }
        $db->close();
    }
}

?>