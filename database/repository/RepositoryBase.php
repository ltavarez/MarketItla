<?php

class RepositoryBase implements IRepository
{

    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function GetAll($entity)
    {
        $list = [];
        $table = get_class($entity);
        $stmt = $this->db->prepare("SELECT * FROM $table");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            while ($row = $result->fetch_object()) {

                $register = new $table();
                foreach ($entity as $key => $value) {
                    $register->{$key} = $row->{$key};
                }
                array_push($list, $register);
            }
        }
        $stmt->close();
        return $list;
    }

    public function GetById($id, $field, $entity)
    {
        $table = get_class($entity);
        $register = new $table;

        $sq = "SELECT * FROM $table where Id = ?";

        if ($field != null) {
            $sq = "SELECT * FROM $table where $field = ?";
        }

        $typeParam = $this->BindParam($id);

        $stmt = $this->db->prepare($sq);
        $stmt->bind_param($typeParam, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            $row = $result->fetch_object();
            foreach ($entity as $key => $value) {
                $register->{$key} = $row->{$key};
            }
        }

        $stmt->close();
        return $register;
    }

    public function Add($entity)
    {
        $table = get_class($entity);
        $fieldInsert = array();
        $valueInsert = array();

        $params = array("");
        foreach ($entity as $key => $value) {
            if ($key != "Id") {
                $params[0] = $params[0] . $this->BindParam($value);
                array_push($params, $value);
                array_push($fieldInsert, $key);
                array_push($valueInsert, "?");
            }
        }
        $valueString = implode(",", $valueInsert);
        $fieldString = implode(",", $fieldInsert);
        $sq = "INSERT INTO $table ($fieldString) VALUES ($valueString)";
        $stmt = $this->db->prepare($sq);

        $bindParams = array();
        foreach ($params as $key => $value) $bindParams[$key] = &$params[$key];

        call_user_func_array(array($stmt, 'bind_param'), $bindParams);
        $stmt->execute();
        $stmt->close();
    }

    public function Update($entity, $field = null)
    {
        $table = get_class($entity);
        $setUpdate = array();
        $params = array("");

        foreach ($entity as $key => $value) {
            if ($key != "Id") {
                $params[0] = $params[0] . $this->BindParam($value);
                array_push($params, $value);
                array_push($setUpdate, $key . " = ?");
            }
        }

        $setString = implode(",", $setUpdate);
        if ($field != null) {
            $sq = "UPDATE $table SET $setString WHERE $field = ?";
            $typeParam = $this->BindParam($field);
            $params[0] = $params[0] . $typeParam;
            array_push($params, $field);
        } else {
            $sq = "UPDATE $table SET $setString WHERE id = ?";
            $typeParam = $this->BindParam($entity->Id);
            $params[0] = $params[0] . $typeParam;
            array_push($params, $entity->Id);
        }
        $stmt = $this->db->prepare($sq);

        $bindParams = array();
        foreach ($params as $key => $value) $bindParams[$key] = &$params[$key];

        call_user_func_array(array($stmt, 'bind_param'), $bindParams);
        $stmt->execute();
        $stmt->close();
    }

    public function Delete($id, $field = null)
    { }

    public function ChangeStatus($id, $fieldStatus, $value, $field = null)
    { }

    public function BindParam($field)
    {
        $type = "";

        switch (gettype($field)) {
            case "integer":
                $type = "i";
                break;
            case "string":
                $type = "s";
                break;
            case "double":
                $type = "d";
                break;
            case "boolean":
                $type = "i";
                break;
            default:
                $type = "s";
        }

        return $type;
    }
}
