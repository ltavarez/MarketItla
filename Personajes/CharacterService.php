<?php

class CharacterService implements IServiceBase
{
    public $utilities;
    public $fileHandler;
    public $directory;
    public $filename;


    function __construct($directory, $filename)
    {
        $this->directory = $directory;
        $this->filename = $filename;
        $this->utilities = new Utilities();
        $this->fileHandler = new JsonFileHandler();
    }

    public function GetById($id)
    {
        $listadoDragonBall = $this->GetList();
        $elementDecode = $this->utilities->searchProperty($listadoDragonBall, 'id', $id)[0];
        $element = new Character();
        $element->set($elementDecode);
        return $element;
    }

    public function GetList()
    {
        $listadoDragonBall = $this->fileHandler->ReadFile($this->directory, $this->filename);

        if ($listadoDragonBall == false) {
            $this->fileHandler->SaveFile($this->directory, $this->filename, array());
            return array();
        }

        return $listadoDragonBall;
    }

    public function Add($entity)
    {
        $listadoDragonBall = $this->GetList();

        $characterId = 1; //El Id del personaje que vamos a crear

        if (!empty($listadoDragonBall)) { //validamos si ya hay personajes creado
            $lastCharacter = $this->utilities->getLastElement($listadoDragonBall); //Obtenemos el ultimo elemento del listado de heroe  
            $characterId =  $lastCharacter->id + 1; //como ya existen heroes el id del nuevo heroe debe ser el id el ultimo + 1
        }

        $entity->id = $characterId;
        $entity->profilePhoto = "";

        if ($_FILES['profilePhoto']) {

            $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
            $type =  $_FILES["profilePhoto"]["type"];
            $size =  $_FILES["profilePhoto"]["size"];
            $name = 'img/' . $characterId . '.' . $typeReplace;

            $sucess = $this->utilities->uploadImage("../Personajes/img", $name, $_FILES['profilePhoto']['tmp_name'], $type, $size);

            if ($sucess) {
                $entity->profilePhoto = $name;
            }
        }

        array_push($listadoDragonBall, $entity); //Agregamos el personaje al listado de personajes


        $this->fileHandler->SaveFile($this->directory, $this->filename, $listadoDragonBall);
    }

    public function Update($id, $entity)
    {        
        $element = $this->GetById($id);
        $listadoDragonBall = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($listadoDragonBall, 'id', $id); //Obtenemos el indice del elemento en el array del listado de heroes que vamos a editar   

        if ($_FILES['profilePhoto']) {

            if ($_FILES['profilePhoto']['error'] == 4) {
                $entity->profilePhoto = $element->profilePhoto;
            } else {
                $typeReplace = str_replace("image/", "", $_FILES["profilePhoto"]["type"]);
                $type =  $_FILES["profilePhoto"]["type"];
                $size =  $_FILES["profilePhoto"]["size"];
                $name = 'img/' . $id . '.' . $typeReplace;

                $sucess = $this->utilities->uploadImage("../Personajes/img", $name, $_FILES['profilePhoto']['tmp_name'], $type, $size);

                if ($sucess) {
                    $entity->profilePhoto = $name;
                }
            }
        }

        $listadoDragonBall[$elementIndex] =  $entity; //Actualizamos los datos del heroe en el listado de heroes utilizando el index obtenido del elemento

        $this->fileHandler->SaveFile($this->directory, $this->filename, $listadoDragonBall);
    }

    public function Delete($id)
    {
        $listadoDragonBall = $this->GetList();
        //Obtenemos el listado actual de heroes almacenado en la session

        $elementIndex = $this->utilities->getIndexElement($listadoDragonBall, 'id', $id); //Obtenemos el indice del elemento en el array del listado de heroes que vamos a editar       


        unset($listadoDragonBall[$elementIndex]);

        $listadoDragonBall = array_values($listadoDragonBall);
        $this->fileHandler->SaveFile($this->directory, $this->filename, $listadoDragonBall);
    }
}
