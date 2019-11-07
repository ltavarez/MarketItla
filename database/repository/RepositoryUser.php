<?php

class RepositoryUser extends RepositoryBase
{

    public $user;

    function __construct($db)
    {
        $this->user = new User();
        parent::__construct($db);
    }

    public function GetAll($entity = null)
    {
        return parent::GetAll($this->user);
    }

    public function GetById($id, $field = null, $entity = null)
    {
        return parent::GetById($id, $field, $this->user);
    }

    public function Update($entity, $field = null)
    {
        return parent::Update($entity, $field = null);
    }

    public function Add($entity)
    {
        return parent::Add($entity);
    }

    public function Login($user, $password)
    {

        $stmt = $this->db->prepare("SELECT * FROM User WHERE UserName = ? AND Password = ?");
        $stmt->bind_param("ss", $user, $password);
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return null;
        } else {
            return $result->fetch_object();
        }
    }
}
