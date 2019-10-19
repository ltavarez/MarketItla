<?php
//incluimos los archivos php que estaremos utilizando
include '../layout/layout.php';
include '../helpers/utilities.php';
require_once 'race.php';
require_once '../services\IServiceBase.php';
require_once 'RaceService.php';

$layout = new Layout(true);
$utilities = new Utilities();
$service = new RaceService();


//Obtenemos el listado actual de personaje almacenado en la session
$listadoRaces = $service->GetList();
$filterName = "";

if (isset($_GET["name"])) {
    $filterName = $_GET["name"];
}

?>

<?php $layout->printHeader(); ?>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0">
    <div class="container">

        <? //php var_dump($listadoDragonBall); 
        ?>

        <?php if (empty($listadoRaces)) : ?>

            <h2>No hay razas registrada, <a href="add.php" class="btn btn-primary my-2"><i class="fa fa-plus-square"></i> Agregar nueva raza</a> </h2>

        <?php else : ?>
            <div style="margin-top: 3%;" class="row">


                <div class="col-md-12">
                    <div class="row" style="margin-bottom: 2%;">
                        <a href="add.php" class="btn bg-success text-white">Nueva Raza</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Opciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listadoRaces as $race) : ?>
                                <tr>
                                    <th scope="col"><?php echo $race->id ?></th>
                                    <th scope="col"><?php echo $race->name ?></th>
                                    <th scope="col">
                                        <div class="btn-group">
                                            <a href="edit.php?id=<?php echo $race->id ?>" class="btn text-white btn-sm btn-outline-secondary btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                            <a href="delete.php?id=<?php echo $race->id ?>" class="btn text-white btn-sm btn-outline-secondary btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
                                        </div>
                                    </th>

                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>
            </div>
        <?php endif; ?>

    </div>
</main>


<?php $layout->printFooter(); ?>


</body>

</html>