<?php

class UserService
{

    public $context;
    public $utility;
    public $repository;

    function __construct($directory)
    {
        $this->context = new MarketItlaContext($directory);
        $this->utility = new Utilities();
        $this->repository = new RepositoryUser($this->context->db);
    }

    public function Login($user, $password)
    {
        $user = $this->utility->makeSafe($user, $this->context->db);
        $password = $this->utility->makeSafe($password, $this->context->db);
        return $this->repository->Login($user, $password);
    }

    public function GetById($id, $field = null)
    {
        return $this->repository->GetById($id, $field);
    }

    public function Update($entity, $field = null)
    {
        $entity->Id = $this->utility->makeSafe($entity->Id, $this->context->db);
        $entity->UserName = $this->utility->makeSafe($entity->UserName, $this->context->db);
        $entity->Password = $this->utility->makeSafe($entity->Password, $this->context->db);
        $entity->FirstName = $this->utility->makeSafe($entity->FirstName, $this->context->db);
        $entity->LastName = $this->utility->makeSafe($entity->LastName, $this->context->db);
        $entity->Email = $this->utility->makeSafe($entity->Email, $this->context->db);
        $entity->Status = $this->utility->makeSafe($entity->Status, $this->context->db);
        return $this->repository->Update($entity, $field);
    }

    public function Add($entity)
    {
        $entity->UserName = $this->utility->makeSafe($entity->UserName, $this->context->db);
        $entity->Password = $this->utility->makeSafe($entity->Password, $this->context->db);
        $entity->FirstName = $this->utility->makeSafe($entity->FirstName, $this->context->db);
        $entity->LastName = $this->utility->makeSafe($entity->LastName, $this->context->db);
        $entity->Email = $this->utility->makeSafe($entity->Email, $this->context->db);
        $entity->Status = $this->utility->makeSafe($entity->Status, $this->context->db);
        return $this->repository->Add($entity);
    }

    public function GetAll()
    {
        return $this->repository->GetAll();
    }
}
