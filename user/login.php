<?php
//incluimos los archivos php que estaremos utilizando
include '../layout\layout.php';
include '../helpers\utilities.php';
include '../helpers/FileHandler/IFileHandler.php';
include '../helpers/FileHandler/SerializationFileHandler.php';
include '../helpers/FileHandler/JsonFileHandler.php';
include '../database/MarketItlaContext.php';
include 'User.php';
include '../database/repository/IRepository.php';
include '../database/repository/RepositoryBase.php';
include '../database/repository/RepositoryUser.php';
include 'UserService.php';


$layout = new Layout(true);
$utilities = new Utilities();
$service = new UserService("../database");

session_start();

$result = null;
$message = "";

if(isset($_SESSION['user']) && $_SESSION['user'] != null ){
  header("Location: ../administrator/dashboard.php");
  exit();
}

if (isset($_POST['userName']) && isset($_POST['Password'])) {
  $result = $service->Login($_POST['userName'], $_POST['Password']);

  if ($result != null) {

    $_SESSION['user'] = $result;
    header("Location: ../administrator/dashboard.php");
    exit();
  } else {
    $message = "Usuario o contrasenia incorrecta";
  }
}

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

    <form method="POST" action="login.php" class="form-signin">

      <?php if ($message != "") : ?>

        <div class="alert alert-danger" role="alert">
          <?= $message; ?>
        </div>

      <?php endif; ?>

      <div class="text-center mb-4">
        <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Market Itla</h1>
      </div>

      <div class="form-label-group">
        <input name="userName" type="text" id="inputEmail" class="form-control" placeholder="Usuario" required="" autofocus="">
        <label for="inputEmail">Usuario</label>
      </div>

      <div class="form-label-group">
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <label for="inputPassword">Password</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar</button>
      <a href="../index.php" class="btn btn-lg btn-warning btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver atras</a>
      <p class="mt-5 mb-3 text-muted text-center">© 2017-2019</p>
    </form>



  </main>


  <?php $layout->printFooter(); ?>


  <link rel="stylesheet" type="text/css" href="../assets/css/floating-label.css">