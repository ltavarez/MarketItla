<?php
//incluimos los archivos php que estaremos utilizando
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'personaje.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../services\IServiceBase.php';
require_once 'CharacterService.php';

$layout = new Layout(true);
$utilities = new Utilities();
$service = new CharacterService("data","personajes");


$containId = isset($_GET['id']); //validamos si hay un parametro id en el query string de la url
$characterId = 0;
$element = null;

if ($containId) {
    $characterId = $_GET['id']; //El Id del personaje que vamos a editar
    $element = $service->GetById($characterId);
}
?>


<?php $layout->printHeader(); ?>

<main role="main">

    <?php if ($containId && $element != null) : ?>
        <div class="row">

            <div class="col-md-2">
                &nbsp;
            </div>

            <div style="margin-top: 5%;" class="col-md-7">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">

                        <h3 class="mb-0"><?php echo $element->name; ?></h3>
                        <div class="mb-1 text-muted"><?php echo $element->getcharacterTypeText(); ?></div>
                        <div style="margin-top: 2%;" class="card" style="width: 18rem;">
                            <h3 style="margin-left: 30%">Poderes</h3>
                            <ul class="list-group list-group-flush">

                                   <?php foreach($element->techniques as $technique):?> 

                                        <li class="list-group-item"><?php echo $technique;?></li>
                                <?php endforeach;?>
                                
                            </ul>
                        </div>

                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img class="bd-placeholder-img card-img-top" src="<?php echo $element->profilePhoto; ?>" width="225" height="225" alt="">
                    </div>
                </div>
            </div>


        </div>

    <?php else : ?>

        <div style="margin-top: 5%;" class="row mb-2">
            <div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">

                        <h2 class="mb-0">No existe</h2>

                    </div>
                </div>
            </div>

        </div>

    <?php endif; ?>

</main>

<?php $layout->printFooter(); ?>