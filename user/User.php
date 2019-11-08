<?php

class User{

    public $Id;
    public $UserName;
    public $Password;
    public $FirstName;
    public $LastName;
    public $Email;
    public $Status;

    public function InitializeData($Id,$UserName,$Password,$FirstName,$LastName,$Email,$Status){
        $this->Id = $Id;
        $this->UserName = $UserName;
        $this->Password = $Password;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        $this->Status = $Status;
    }

}

?>