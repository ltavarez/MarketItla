<?php

interface IRepository{

    public function GetAll($entity);

    public function GetById($id,$field,$entity);

    public function Add($entity);

    public function Update($entity);

    public function Delete($id, $field = null);

    public function ChangeStatus($id,$fieldStatus,$value,$field = null);

    public function BindParam($field);
}

?>