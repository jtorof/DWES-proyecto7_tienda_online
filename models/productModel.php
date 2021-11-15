<?php

class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $stock;

    public function __construct ($data){
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        if ($data['stock']<=0) {
            $this->stock = 'No hay stock';
        } else {
            $this->stock = $data['stock'];
        }        
    }

    //método mágico toString
    public function __toString() {
        return 'Producto: '.$this->name.', Descripción: '.$this->description.', Precio: '.$this->price.'€, Stock:'.$this->stock.'.';
    } 
    
    //método magico get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}



?>