<?php

class RaceService implements IServiceBase
{

    public function GetById($id)
    {
        $utilities = new Utilities();
        $listadoRaces = $this->GetList();
        $elementDecode = $utilities->searchProperty($listadoRaces, 'id', $id)[0];
        $element = New Race();
        $element->set($elementDecode);
        return $element;
    }

    public function GetList()
    {
        $utilities = new Utilities();
        $listadoRaces = array();

        if (isset($_COOKIE['races'])) {
            $listadoRaces = json_decode($_COOKIE['races'],false); 
        } else {
            setcookie("races", json_encode($listadoRaces), $utilities->GetCookieTime(), "/");
        }

        return $listadoRaces;
    }

    public function Add($entity)
    {
        $utilities = new Utilities();
        $listadoRaces = $this->GetList();

        $racesId = 1; //El Id del personaje que vamos a crear

        if (!empty($listadoRaces)) { //validamos si ya hay personajes creado
            $lastCharacter = $utilities->getLastElement($listadoRaces); //Obtenemos el ultimo elemento del listado de heroe  
            $racesId =  $lastCharacter->id + 1; //como ya existen heroes el id del nuevo heroe debe ser el id el ultimo + 1
        }

        $entity->id = $racesId;

        array_push($listadoRaces, $entity); //Agregamos el personaje al listado de personajes

        setcookie("races", json_encode($listadoRaces), $utilities->GetCookieTime(), "/");
    }

    public function Update($id, $entity)
    {
        $utilities = new Utilities();      
        $listadoRaces = $this->GetList();
        $elementIndex = $utilities->getIndexElement($listadoRaces, 'id', $id); //Obtenemos el indice del elemento en el array del listado de heroes que vamos a editar   

    

        $listadoRaces[$elementIndex] =  $entity; //Actualizamos los datos del heroe en el listado de heroes utilizando el index obtenido del elemento

        setcookie("races", json_encode($listadoRaces), $utilities->GetCookieTime(), "/");
    }

    public function Delete($id)
    {
        $utilities = new Utilities();
        $listadoRaces = $this->GetList();
        //Obtenemos el listado actual de heroes almacenado en la session

        $elementIndex = $utilities->getIndexElement($listadoRaces, 'id', $id); //Obtenemos el indice del elemento en el array del listado de heroes que vamos a editar       
 
    
        unset($listadoRaces[$elementIndex]);

        $listadoRaces = array_values($listadoRaces);
        setcookie("races", json_encode($listadoRaces), $utilities->GetCookieTime(), "/");
    }
}
