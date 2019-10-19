<?php
//incluimos los archivos php que estaremos utilizando

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'personaje.php';
require_once '../services\IServiceBase.php';
require_once 'CharacterService.php';
require_once '../Races/RaceService.php';

$layout = new Layout(true);
$utilities = new Utilities();
$service = new CharacterService();
$raceService = new RaceService();

//Validamos si existen valores en la variable de $_POST 
if (isset($_POST['name']) && isset($_POST['characterType']) && isset($_POST['raceId']) && isset($_POST['techniques'])) {

    $techniques = explode(",", $_POST['techniques']);
    $newCharacter = new Character();

    $newCharacter->InitializeData($characterId, $_POST['name'], $_POST['characterType'], $_POST['raceId'], $techniques);

    $service->Add($newCharacter);

    header("Location: ../index.php"); //enviamos a la pagina principal del website
    exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento
}

?>

<?php $layout->printHeader(); ?>

<main role="main">

    <div style="margin-top: 10%;margin-bottom: 5%;" class="card">
        <div class="card-header text-white bg-primary">
            Registra un nuevo personaje
        </div>
        <div class="card-body">


            <form method="POST" action="add.php" enctype="multipart/form-data">

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="InputName">Nombre</label>
                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Introduzca el nombre ">

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="characterTypeInput"> Tipo de personaje </label>
                        <select name="characterType" class="form-control" id="characterTypeInput">

                            <?php foreach ($utilities->characterTypeList as $id => $text) : ?>
                                <option value="<?php echo $id ?>"><?php echo $text ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="raceInput"> Raza </label>

                        <select name="raceId" class="form-control" id="raceInput">

                            <?php foreach ($raceService->GetList() as $race) : ?>
                                <option value="<?php echo $race->id ?>"><?php echo $race->name ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="InputTechniques">Tecnicas</label>
                        <textarea name="techniques" class="form-control" id="InputTechniques" aria-describedby="TechniquesHelp" placeholder="Introduzca las tecnicas "> </textarea>
                        <small id="TechniquesHelp" class="form-text text-muted">Colocar poderes separados por comas</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="characterPhoto">Foto del personaje</label>
                        <input type="file" name="profilePhoto" class="form-control-file" id="characterPhoto">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Crear</button>
            </form>

        </div>
    </div>

</main>

<?php $layout->printFooter(); ?>