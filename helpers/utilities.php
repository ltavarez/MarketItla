<?php


class Utilities
{
    public $characterTypeList = [1 => "Heroe", 2 => "Villano"];

    /* Este metodo retorna el ultimo elemento del un array */
    public function getLastElement($list)
    {
        $countList = count($list);
        $lastElement = $list[$countList - 1];

        return $lastElement;
    }

    /* Este metodo realiza una busqueda en un listado por la propiedad y valor que pasemos por parametros
   Retorna: Un listado con el filtro que realizamos */
    public function searchProperty($list, $property, $value)
    {
        $filter = [];

        foreach ($list as $item) {
            if ($item != null) {
                if ($item->$property == $value) {
                    array_push($filter, $item);
                }
            }
        }

        return $filter;
    }

    /* Este metodo realiza una busqueda en un listado por la propiedad y valor que pasemos por parametros
   Retorna: El index del primer elemento que cumpla con la condicion de busqueda */
    public function getIndexElement($list, $property, $value)
    {
        $index = 0;      
        foreach ($list as $key => $item) {
            if ($item != null) {
                if ($item->$property == $value) {
                    $index = $key;
                    break;
                }
            }            
        }
        return $index;
    }

    public function GetCookieTime()
    {
        return time() + 60*60*24*30;
    }

    public function makeSafe($value){
        $context = new MarketItlaContext("../database");   
        return $context->db->real_escape_string($value);
 
     }

    public function uploadImage($directory, $name, $tmpFile, $type, $size)
    {
        $isSuccess = false;

        if ((($type == "image/gif")
                || ($type == "image/jpeg")
                || ($type == "image/png")
                || ($type == "image/jpg")
                || ($type == "image/JPG")
                || ($type == "image/pjpeg"))
            && ($size < 1000000)
        ) {

            if (!file_exists($directory)) {

                mkdir($directory, 0777, true);

                if (file_exists($directory)) {

                    if (file_exists($name)) {
                        unlink($name);
                    }

                    move_uploaded_file($tmpFile,  $name);
                    $isSuccess = true;
                }
            } else {

                if (file_exists($name)) {
                    unlink($name);
                }

                move_uploaded_file($tmpFile, $name);
                $isSuccess = true;
            }
        } else {
            $isSuccess = false;
        }

        return $isSuccess;
    }
}
