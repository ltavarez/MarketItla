<?php
class Race
{
    public $id;
    public $name;
  

    public function __construct() {}

    public function InitializeData(
        $id,
        $name
    
    ) {
        $this->id = $id;
        $this->name = $name;        
    }

    public function set($data) {
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

  

   
}
