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

$containId = isset($_GET['id']);
$element = null;

if ($containId) {
    $id = $_GET['id'];
    $element = $service->GetById($id);  
}

if (isset($_POST['Name'])) {

    $updateEntity = new Brand();
    $updateEntity->InitializeData($id, $_POST['Name']);
    $service->Update($updateEntity);

    header("Location: list.php");
    exit();
}
?>

<?php $layout->printHeaderAdministrator(true); ?>

<main style="margin-top:1%;" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <?php if ($containId && $element != null) : ?>

            <div style="margin-top: 3%" class="card col-md-10">
                <div class="card-header bg-warning ">
                    <a href="list.php" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver atrás</a> <strong> Editando la marca <?php echo $element->Name;  ?></strong>
                </div>
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="edit.php?id=<?php echo $element->Id ?>">

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputUserName">Nombre de la marca</label>
                                <input required type="text" value="<?php echo $element->Name; ?>" required name="Name" class="form-control" id="InputUserName">

                            </div>
                        </div>                       
                

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </form>

                </div>
            </div>

        <?php else : ?>

            <h2>No existe</h2>

        <?php endif; ?>
    </div>
</main>
<?php $layout->printFooterAdministrator(); ?>