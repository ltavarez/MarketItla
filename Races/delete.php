<?php
//incluimos los archivos php que estaremos utilizando
require_once '../helpers/utilities.php';
require_once 'race.php';
require_once '../services\IServiceBase.php';
require_once 'RaceService.php';

$service = new RaceService();


$containId = isset($_GET['id']); //validamos si hay un parametro id en el query string de la url
$raceId = 0;


if ($containId) {
    $raceId = $_GET['id']; //El Id del personaje que vamos a editar   
    $service->Delete($raceId);

}

 header("Location: list.php"); //enviamos a la pagina principal del website
 exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento

?>