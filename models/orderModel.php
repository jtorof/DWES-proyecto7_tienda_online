<?php

class Order {
    private $id;
    private $customerId;
    private $totalCost;
    private $date;
    private $status;

    public function __construct ($data){
        $this->id = $data['id'];
        $this->customerId = $data['customerid'];
        $this->totalCost = $data['totalcost'];
        $this->date = $data['date'];
        $this->status = $data['status'];
    }

    //método mágico toString
    public function __toString() {        
        return 'Pedido con referencia: '.$this->id.', Coste: '.$this->totalCost.'€, Fecha: '.$this->date.', Estado: '.$this->status.'.';
    } 

    //método magico get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}

?>