<?php
//incluimos los archivos php que estaremos utilizando
include '../helpers/auth.php';
include '../layout/layout.php';
include '../helpers/utilities.php';
include '../helpers/FileHandler/IFileHandler.php';
include '../helpers/FileHandler/JsonFileHandler.php';
include '../database/MarketItlaContext.php';
include 'Brand.php';
include '../database/repository/IRepository.php';
include '../database/repository/RepositoryBase.php';
include '../database/repository/RepositoryBrand.php';
include 'BrandService.php';

$layout = new Layout(true);
$utilities = new Utilities();
$service = new BrandService("../database");

if (isset($_POST['Name']) ) {

    $newEntity = new Brand();
    $newEntity->InitializeData(0, $_POST['Name']);
    $service->Add($newEntity);

    header("Location: list.php"); 
    exit(); 
}
?>

<?php $layout->printHeaderAdministrator(true); ?>

<main style="margin-top:1%;" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div style="margin-top: 1%;margin-bottom: 5%;" class="col-md-10 card">
            <div class="card-header text-white bg-primary">
            <a href="list.php" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver atrás</a> <b>Registra una nueva marca</b>
            </div>
            <div class="card-body">

                <form method="POST" action="add.php" enctype="multipart/form-data">

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputUserName">Nombre de la marca</label>
                            <input type="text" required name="Name" class="form-control" id="InputUserName">

                        </div>
                    </div>

                  

                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Crear</button>
                </form>

            </div>
        </div>
    </div>
</main>
<?php $layout->printFooterAdministrator(); ?>