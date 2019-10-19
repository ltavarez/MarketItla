<?php

interface IServiceBase{

    public function GetById($id);
    public function GetList();
    public function Add($entity);
    public function Update($id,$entity);
    public function Delete($id);

}

?>