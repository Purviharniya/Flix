<?php 

class User{
    private $con,$username,$sqlData;

    public function __construct($con,$username){
        $this->con = $con;
        $this->username = $username;

        $query = $con->prepare("SELECT * from users where username=:username");
        $query->bindValue(":username",$username);
        
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getFname(){
        return $this->sqlData['firstName'];
    }

    public function getLname(){
        return $this->sqlData['lastName'];
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->sqlData['email'];
    }

    public function getIsSubscribed(){
        return $this->sqlData['isSubscribed'];
    }
    
    public function setIsSubscribed($value){
        $query = $this->con->prepare("UPDATE users set isSubscribed=:subs where username=:username");
        $query->bindValue(":subs",$value);
        $query->bindValue(":username",$this->username);
        if($query->execute()){
            $this->sqlData['isSubscribed'] = $value;
            return true;
        }
        return false;
    }
}