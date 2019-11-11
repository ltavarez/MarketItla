<?php

class Brand{

    public $Id;
    public $Name;   

    public function InitializeData($Id,$Name){
        $this->Id = $Id;
        $this->Name = $Name;     
    }

}

?>