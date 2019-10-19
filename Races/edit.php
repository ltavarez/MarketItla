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

$containId = isset($_GET['id']); //validamos si hay un parametro id en el query string de la url
$characterId = 0;

$element = [];

if ($containId) {
    $raceId = $_GET['id']; //El Id del personaje que vamos a editar
    $element = $service->GetById($raceId);
   
}

if (isset($_POST['name'])) { //aqui verificamos si estamos recibiendo valores por $_POST para editar los valores del elemento en el listado de heroes de la session 

    $updateCharacter = new Race();
    $updateCharacter->InitializeData($raceId, $_POST['name']);

    $service->Update($raceId, $updateCharacter);
   

    header("Location: list.php"); //enviamos a la pagina principal del website
    exit(); //esto detiene la ejecucion del php para que se realice el redireccionamiento
}
?>


<?php $layout->printHeader(); ?>

<main role="main">

    <?php if ($containId && $element != null) : ?>

        <div style="margin-top: 5%" class="card">
            <div class="card-header bg-warning text-white">
                <strong> Editando la raza <?php echo $element->name ?></strong>
            </div>
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="edit.php?id=<?php echo $element->id ?>">

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputName">Nombre</label>
                            <input type="text" name="name" value="<?php echo $element->name ?>" class="form-control" id="InputName" placeholder="Introduzca el nombre ">

                        </div>
                    </div>                         

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </form>

            </div>
        </div>

    <?php else : ?>

        <h2>No existe</h2>

    <?php endif; ?>

</main>

<?php $layout->printFooter(); ?>