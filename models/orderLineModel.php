<?php

class OrderLine {
    private $id;
    private $orderId;
    private $productId;
    private $quantity;

    public function __construct ($data){
        $this->id = $data['id'];
        $this->orderId = $data['orderid'];
        $this->productId = $data['productid'];
        $this->quantity = $data['quantity'];
    }

    //método mágico toString
    public function __toString() {
        $product=productRepository::getProductById($this->productId);
        return 'Producto: '.$product->name.', Precio: '.$product->price.'€, Cantidad:'.$this->quantity.'.';
    } 

    //método magico get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function getCost() {
        $product=productRepository::getProductById($this->productId);
        return $cost=$product->price * $this->quantity;
    }
}

?>