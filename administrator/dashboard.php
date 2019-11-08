<?php
//incluimos los archivos php que estaremos utilizando
include '../layout\layout.php';
include '../helpers\utilities.php';
include '../helpers/FileHandler/IFileHandler.php';
include '../helpers/FileHandler/SerializationFileHandler.php';
include '../helpers/FileHandler/JsonFileHandler.php';
include '../helpers/auth.php';

$layout = new Layout(true);
$utilities = new Utilities();
$filterName = "";

if (isset($_GET["name"])) {
    $filterName = $_GET["name"];
}

?>

<?php $layout->printHeaderAdministrator(false); ?>

            <main style="margin-top:4%;" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">               
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
            </main>
        </div>
    </div>



    <?php $layout->printFooterAdministrator(); ?>


