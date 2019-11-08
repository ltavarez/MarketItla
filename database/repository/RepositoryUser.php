<?php

class RepositoryUser extends RepositoryBase
{

    public $user;
    public $utility;

    function __construct($db)
    {
        $this->user = new User();
        $this->utility = new Utilities();
        parent::__construct($db);
    }

    public function GetAll($entity = null)
    {
        return parent::GetAll($this->user);
    }

    public function GetAllActive($entity = null, $field = null)
    {
        return parent::GetAllActive($this->user, $field);
    }

    public function GetAllInactive($entity = null, $field = null)
    {
        return parent::GetAllInactive($this->user, $field);
    }

    public function GetById($id, $field = null, $entity = null)
    {
        return parent::GetById($id, $field, $this->user);
    }

    public function Update($entity, $field = null)
    {
        return parent::Update($entity, $field = null);
    }

    public function ChangeStatus($id, $value, $fieldStatus = null,$field = null, $entity = null)
    {
        return parent::ChangeStatus($id, $value, $fieldStatus,$field, $this->user );
    }

    public function Add($entity)
    {
        return parent::Add($entity);
    }

    public function Delete($id,$entity=null, $field = null)
    {
        return parent::Delete($id,$this->user);
    }

    public function Login($user, $password)
    {
        $user = $this->utility->makeSafe($user, $this->db);
        $password = $this->utility->makeSafe($password, $this->db);
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
