<?php
//incluimos los archivos php que estaremos utilizando
include 'layout\layout.php';
include 'helpers\utilities.php';
include 'helpers/FileHandler/IFileHandler.php';
include 'helpers/FileHandler/SerializationFileHandler.php';
include 'helpers/FileHandler/JsonFileHandler.php';
require_once 'Personajes\personaje.php';
require_once 'services\IServiceBase.php';
require_once 'Personajes\CharacterService.php';
require_once 'Races\RaceService.php';

$layout = new Layout(false);
$utilities = new Utilities();
$service = new CharacterService("Personajes/data","personajes");
$raceService = new RaceService();


//Obtenemos el listado actual de personaje almacenado en la session
$listadoDragonBall = $service->GetList();
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

        <?php if (empty($listadoDragonBall)) : ?>

            <h2>No hay personajes registrado, <a href="Personajes/add.php" class="btn btn-primary my-2"><i class="fa fa-plus-square"></i> Agregar nuevo super personaje</a> </h2>

        <?php else : ?>
            <div style="margin-top: 3%;" class="row">

                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Filtros
                        </div>
                        <div class="card-body">

                            <form method="GET" action="index.php">
                                <div class="form-group">
                                    <label for="nameInput">Nombre</label>
                                    <input type="text" value="<?php echo $filterName; ?>" name="name" class="form-control" id="nameInput">

                                </div>


                                <div class="form-group">
                                    <label for="raceInput"> Raza </label>

                                    <select name="raceId" class="form-control" id="raceInput">

                                        <?php foreach ($raceService->GetList() as $race) : ?>
                                            <option value="<?php echo $race->id ?>"><?php echo $race->name ?></option>
                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="characterTypeInput"> Tipo de personaje </label>
                                    <select name="characterType" class="form-control" id="characterTypeInput">

                                        <?php foreach ($utilities->characterTypeList as $id => $text) : ?>
                                            <option value="<?php echo $id ?>"><?php echo $text ?></option>
                                        <?php endforeach; ?>

                                    </select>

                                </div>


                                <button type="submit" class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                            </form>

                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <?php $i = 1; ?>
                    <?php foreach ($listadoDragonBall as $personaje) : ?>

                        <?php if ($i == 1) : ?>
                            <div class="row">
                            <?php endif; ?>
                            <div class="col-md-6">
                                <div class="card mb-6 shadow-sm">

                                    <img class="bd-placeholder-img card-img-top" src="<?php echo "Personajes/" . $personaje->profilePhoto; ?>" width="100%" height="225" alt="">

                                    <div class="card-body">
                                        <p class="card-text"><strong> <?php echo $personaje->name; ?> </strong></p>
                                        <div class="d-flex justify-content-between align-items-center">

                                            <div class="btn-group">
                                                <a href="Personajes/details.php?id=<?php echo $personaje->id ?>" class="btn text-white btn-sm btn-outline-secondary btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i> Detalle</a>
                                                <a href="Personajes/edit.php?id=<?php echo $personaje->id ?>" class="btn text-white btn-sm btn-outline-secondary btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                <a href="Personajes/delete.php?id=<?php echo $personaje->id ?>" class="btn text-white btn-sm btn-outline-secondary btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($i == 2) : ?>
                            </div>

                            <?php $i = 1; ?>
                        <?php else : ?>
                            <?php $i += 1; ?>
                        <?php endif; ?>


                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>


<?php $layout->printFooter(); ?>


</body>

</html>