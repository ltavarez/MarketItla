<?php

class UserService{


    public $context;
    public $utility;

    function __construct($directory)
    {
        $this->context = new MarketItlaContext($directory); 
        $this->utility = new Utilities();   
    }

    public function Login($user,$password){
       
        $user = $this->utility->makeSafe($user);
        $password = $this->utility->makeSafe($password);

        $stmt = $this->context->db->prepare("SELECT * FROM User WHERE UserName = ? AND Password = ?");
        $stmt->bind_param("ss",$user, $password);
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();      

        if($result->num_rows === 0){
            return null;
        }
        else{
            return $result->fetch_object();
        }

    }

 

}

?>