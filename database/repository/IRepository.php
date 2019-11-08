<?php

interface IRepository{

    public function GetAll($entity);

    public function GetById($id,$field,$entity);

    public function Add($entity);

    public function Update($entity);

    public function Delete($id,$entity, $field = null);

    public function ChangeStatus($id, $value, $fieldStatus = null,$field = null, $entity = null);

    public function BindParam($field);

    public function MakeSafeEntity($entity);
}
