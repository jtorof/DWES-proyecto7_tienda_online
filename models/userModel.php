<?php

class User {
    private $id;
    private $userName;
    private $fullName;
    private $email;
    private $role;   

    public function __construct ($data){
        $this->id = $data['id'];
        $this->userName = $data['username'];
        $this->fullName = $data['fullname'];
        $this->email = $data['email'];
        $this->role = $data['role'];
    }

    //método mágico toString
    public function __toString() {
        return 'Nombre completo: '.$this->fullName.', Usuario: '.$this->userName.', Email: '.$this->email.'';
    }   

    //metoo magico get
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } 
    }
}

?>