<?php

class CharacterService implements IServiceBase
{

    public function GetById($id)
    {
        $utilities = new Utilities();
        $listadoDragonBall = $this->GetList();
        $elementDecode = $utilities->searchProperty($listadoDragonBall, 'id', $id)[0];
        $element = New Character();
        $element->set($elementDecode);
        return $element;
    }

    public function GetList()
    {
        $utilities = new Utilities();
        $listadoDragonBall = array();

        if (isset($_COOKIE['dragonball'])) {
            $listadoDragonBall = json_decode($_COOKIE['dragonball'],false); 
        } else {
            setcookie("dragonball", json_encode($listadoDragonBall), $utilities->GetCookieTime(), "/");
        }

        return $listadoDragonBall;
    }

    public function Add($entity)
    {
        $utilities = new Utilities();
        $listadoDragonBall = $this->GetList();

        $characterId = 1; //El Id del personaje que vamos a crear

        if (!empty($listadoDragonBall)) { //validamos si ya hay personajes creado
            $lastCharacter = $utilities->getLastElement($listadoDragonBall); //Obtenemos el ultimo elemento del listado de heroe  
            $characterId =  $lastCharacter->id + 1; //como ya existen heroes el id del nuevo heroe debe ser el id el ultimo + 1
        }

        $entity->id = $characterId;
        $entity->profilePhoto = "";

        if ($_FILES['profilePhoto']) {

            $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
            $type =  $_FILES["profilePhoto"]["type"];
            $size =  $_FILES["profilePhoto"]["size"];
            $name = 'img/' . $characterId . '.' . $typeReplace;

            $sucess = $utilities->uploadImage("../Personajes/img", $name, $_FILES['profilePhoto']['tmp_name'], $type, $size);

            if ($sucess) {
                $entity->profilePhoto = $name;
            }
        }

        array_push($listadoDragonBall, $entity); //Agregamos el personaje al listado de personajes

        setcookie("dragonball", json_encode($listadoDragonBall), $utilities->GetCookieTime(), "/");
    }

    public function Update($id, $entity)
    {
        $utilities = new Utilities();
        $element = $this->GetById($id);
        $listadoDragonBall = $this->GetList();

        $elementIndex = $utilities->getIndexElement($listadoDragonBall, 'id', $id); //Obtenemos el indice del elemento en el array del listado de heroes que vamos a editar   

        if ($_FILES['profilePhoto']) {

            if ($_FILES['profilePhoto']['error'] == 4) {
                $entity->profilePhoto = $element->profilePhoto;
            } else {
                $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
                $type =  $_FILES["profilePhoto"]["type"];
                $size =  $_FILES["profilePhoto"]["size"];
                $name = 'img/' . $id . '.' . $typeReplace;

                $sucess = $utilities->uploadImage("../Personajes/img", $name, $_FILES['profilePhoto']['tmp_name'], $type, $size);

                if ($sucess) {
                    $entity->profilePhoto = $name;
                }
            }
        }

        $listadoDragonBall[$elementIndex] =  $entity; //Actualizamos los datos del heroe en el listado de heroes utilizando el index obtenido del elemento

        setcookie("dragonball", json_encode($listadoDragonBall), $utilities->GetCookieTime(), "/");
    }

    public function Delete($id)
    {
        $utilities = new Utilities();
        $listadoDragonBall = $this->GetList();
        //Obtenemos el listado actual de heroes almacenado en la session

        $elementIndex = $utilities->getIndexElement($listadoDragonBall, 'id', $id); //Obtenemos el indice del elemento en el array del listado de heroes que vamos a editar       
 
    
        unset($listadoDragonBall[$elementIndex]);

        $listadoDragonBall = array_values($listadoDragonBall);
        setcookie("dragonball", json_encode($listadoDragonBall), $utilities->GetCookieTime(), "/");
    }
}
