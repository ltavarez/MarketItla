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


//Obtenemos el listado actual de personaje almacenado en la session
$listado = $service->GetAll();

?>

<?php $layout->printHeaderAdministrator(true); ?>

<!-- Begin page content -->

<main style="margin-top:2%;" role="main" class="col-md-12 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <?php if (empty($listado)) : ?>

            <h2>No hay marcas registrada, <a href="add.php" class="btn btn-primary my-2"><i class="fa fa-plus-square"></i> Agregar nuevo marca</a> </h2>

        <?php else : ?>
            <div class="row">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <b>Marcas</b>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row" style="margin-bottom: 2%;">
                                <a href="add.php" class="btn bg-success text-white"><b> Nuevo Marca</b></a>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>                                   
                                        <th scope="col">Nombre</th>                               

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listado as $marca) : ?>
                                        <tr>
                                            <th scope="col"><?php echo $marca->Id ?></th>
                                            <th scope="col"><?php echo $marca->Name ?></th>
                                           
                                            <th scope="col">
                                                <div class="btn-group">
                                                    <a href="edit.php?id=<?php echo $marca->Id ?>" class="btn text-white btn-sm btn-outline-secondary btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                    <a href="#" data-id="<?php echo $marca->Id ?>" class="btn text-white btn-sm btn-outline-secondary btn-danger delete-button"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
                                                </div>
                                            </th>

                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        <?php endif; ?>
    </div>

    <?php $layout->printFooterAdministrator(); ?>

    <script>
        $(document).ready(function() {

            $(".delete-button").on("click", function() {

                if (confirm("Esta seguro que deseas borrar este usuario ?")) {
                    window.location = "delete.php?id=" + $(this).data("id");
                }
            });
        });
    </script>