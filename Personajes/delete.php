<?php
//incluimos los archivos php que estaremos utilizando
require_once '../helpers/utilities.php';
require_once 'personaje.php';
require_once '../services\IServiceBase.php';
require_once 'CharacterService.php';

$service = new CharacterService();


$containId = isset($_GET['id']); //validamos si hay un parametro id en el query string de la url
$characterId = 0;


if ($containId) {
    $characterId = $_GET['id']; //El Id del personaje que vamos a editar   
    $service->Delete($characterId);

}

 header("Location: ../index.php"); //enviamos a la pagina principal del website
 exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento

?>