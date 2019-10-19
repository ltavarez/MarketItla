<?php
//incluimos los archivos php que estaremos utilizando

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'race.php';
require_once '../services\IServiceBase.php';
require_once 'RaceService.php';

$layout = new Layout(true);
$utilities = new Utilities();
$service = new RaceService();

//Validamos si existen valores en la variable de $_POST 
if (isset($_POST['name'])) {

  
    $newRace = new Race();

    $newRace->InitializeData(0, $_POST['name']);

    $service->Add($newRace);

    header("Location: list.php"); //enviamos a la pagina principal del website
    exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento
}

?>

<?php $layout->printHeader(); ?>

<main role="main">

    <div style="margin-top: 10%;margin-bottom: 5%;" class="card">
        <div class="card-header text-white bg-primary">
            Registra una nueva raza
        </div>
        <div class="card-body">


            <form method="POST" action="add.php" enctype="multipart/form-data">

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="InputName">Nombre</label>
                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Introduzca el nombre ">

                    </div>
                </div>    

                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Crear</button>
            </form>

        </div>
    </div>

</main>

<?php $layout->printFooter(); ?>