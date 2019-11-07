<?php

class MarketItlaContext{


    public $db;

    function __construct($directory)
    {
        $fileHandler = new JsonFileHandler();
        $configuration = $fileHandler->ReadConfiguration($directory,"configuration");
        $this->db = new mysqli($configuration->server,$configuration->user,$configuration->password,$configuration->database);
        
        if($this->db->connect_error) {
            exit('Error connecting to database'); //Should be a message a typical user could understand in production
        }

      
      
    }

}

?>