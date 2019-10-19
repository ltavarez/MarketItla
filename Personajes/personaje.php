<?php
class Character
{
    public $id;
    public $name;
    public $characterType;
    public $raceId;
    public $techniques;
    public $profilePhoto;  

    public function __construct() {}

    public function InitializeData(
        $id,
        $name,
        $characterType,
        $raceId,
        $techniques
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->characterType = $characterType;
        $this->raceId = $raceId;
        $this->techniques = $techniques;
        
    }

    public function set($data) {
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

    public function getEditableTechniques()
    {
        if (!empty($this->techniques)) {
            return implode(",", $this->techniques);
        } else {
            return "";
        }
    }

    public function getcharacterTypeText()
    {
        $utilities = new Utilities();

        if($this->characterType != 0 && $this->characterType != null){
            return $utilities->characterTypeList[$this->characterType]; 
        }
    }
}
