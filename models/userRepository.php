<?php

class UserRepository {
    public static function login ($u, $p) {
        $db=Conectar::conexion();
        $result = $db->query("SELECT * from users WHERE username='".$u."' AND password='".md5($p)."' AND hidden='0'");
        if($data=$result->fetch_assoc())
        return new User($data);
    }

    public static function register ($f, $u, $p, $e) {
        $db=Conectar::conexion();      
        //comprobar si existe ya ese usuario?
        $exists=false;
        $users=userRepository::getUsers();
        foreach ($users as $user) {
            if ($user->userName == $u) {
                $exists = true;
            }
        }
        if (!$exists) {
            $result = $db->query("INSERT INTO users (fullname, username, password, email) 
            VALUES('".$f."', '".$u."', '".md5($p)."', '".$e."')");
        }
        $db->close();
    }

    //metodo para sacar todos los users
	public static function getUsers(){
		$db=Conectar::conexion();
		$users= array();
		$result= $db->query("SELECT id, fullname, username, role, email FROM users WHERE hidden='0'");
        //$result= $db->query("SELECT * FROM users");
		while($row=$result->fetch_assoc()){
				$users[]=new User($row);
			}
		return $users;
	}

    public static function changeRole($id, $role) {
        $db=Conectar::conexion();
        $result= $db->query("UPDATE users SET role='".$role."' WHERE id='".$id."'");
    }

    public static function getUserById($id) {
        $db=Conectar::conexion();
        $result = $db->query("SELECT * FROM users WHERE id='".$id."'");
        if($data=$result->fetch_assoc())
        return new User($data);
    }

    public static function changeData($id, $fullname, $username, $email) { 
        $db=Conectar::conexion();
        $result= $db->query("UPDATE users SET fullname='".$fullname."', username='".$username."', email='".$email."' WHERE id='".$id."'"); 
        $db->close();
        return $result;
    }

    public static function deleteUser($id){
        $db=Conectar::conexion();        
        $result= $db->query("UPDATE users SET hidden='1' WHERE id='".$id."'");         
    }    
}

?>