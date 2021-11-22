<?php

class ProductRepository {
    //metodo para sacar todos los productos
	public static function getProducts(){
		$db=Conectar::conexion();
		$products= array();
		$result= $db->query("SELECT * FROM products WHERE hidden='0' AND stock>'0'");
        //trigger para que cuando stock=0 hidden=1 y quitar el stock<0 ?
		while($row=$result->fetch_assoc()){
				$products[]=new Product($row);
			}
		return $products;
	}

    public static function getProductById($id) {
        $db=Conectar::conexion();
        $result = $db->query("SELECT * FROM products WHERE id='".$id."'");
        if($data=$result->fetch_assoc())
        return new Product($data);
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

    public static function checkStock($id, $substraction){
        $db=Conectar::conexion(); 
        $product=productRepository::getProductById($id);
        //var_dump($product->stock);
        if ($product->stock<$substraction) {
            return false;
        } else {
            return true;
        }
    }

    public static function adjustStock($id, $substraction){
        $db=Conectar::conexion();         
        $db->query("UPDATE products
            SET stock=stock - '".$substraction."'
            WHERE id='".$id."'");        
    }
}

?>