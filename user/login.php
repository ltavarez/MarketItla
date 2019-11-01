<?php
//incluimos los archivos php que estaremos utilizando
include '../layout\layout.php';
include '../helpers\utilities.php';
include '../helpers/FileHandler/IFileHandler.php';
include '../helpers/FileHandler/SerializationFileHandler.php';
include '../helpers/FileHandler/JsonFileHandler.php';


$layout = new Layout(true);
$utilities = new Utilities();


$filterName = "";

if (isset($_GET["name"])) {
    $filterName = $_GET["name"];
}

?>

<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Market</title>
    </head>
    
    <body class="d-flex flex-column h-100">

<main>
 
<form class="form-signin">
  <div class="text-center mb-4">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Market Itla</h1>   
  </div>

  <div class="form-label-group">
    <input type="email" id="inputEmail" class="form-control" placeholder="Usuario" required="" autofocus="">
    <label for="inputEmail">Usuario</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
    <label for="inputPassword">Password</label>
  </div>
 
  <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar</button>
  <a href="../index.php" class="btn btn-lg btn-warning btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver atras</a>
  <p class="mt-5 mb-3 text-muted text-center">© 2017-2019</p>
</form>



</main>


<?php $layout->printFooter(); ?>


<link rel="stylesheet" type="text/css" href="../assets/css/floating-label.css">

