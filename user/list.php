<?php
//incluimos los archivos php que estaremos utilizando
include '../helpers/auth.php';
include '../layout/layout.php';
include '../helpers/utilities.php';
include '../helpers/FileHandler/IFileHandler.php';
include '../helpers/FileHandler/JsonFileHandler.php';
include '../database/MarketItlaContext.php';
include '../user/User.php';
include '../database/repository/IRepository.php';
include '../database/repository/RepositoryBase.php';
include '../database/repository/RepositoryUser.php';
include '../user/UserService.php';

$layout = new Layout(true);
$utilities = new Utilities();
$service = new UserService("../database");


//Obtenemos el listado actual de personaje almacenado en la session
$listadoUsuarios = $service->GetAll();

?>

<?php $layout->printHeaderAdministrator(true); ?>

<!-- Begin page content -->

<main style="margin-top:2%;" role="main" class="col-md-12 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <?php if (empty($listadoUsuarios)) : ?>

            <h2>No hay usuarios registrado, <a href="add.php" class="btn btn-primary my-2"><i class="fa fa-plus-square"></i> Agregar nuevo usuario</a> </h2>

        <?php else : ?>
            <div class="row">
                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <b>Usuarios</b>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row" style="margin-bottom: 2%;">
                                <a href="add.php" class="btn bg-success text-white"><b> Nuevo Usuario</b></a>
                            </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Opciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listadoUsuarios as $usuario) : ?>
                                        <tr>
                                            <th scope="col"><?php echo $usuario->Id ?></th>
                                            <th scope="col"><?php echo $usuario->UserName ?></th>
                                            <th scope="col"><?php echo $usuario->FirstName ?></th>
                                            <th scope="col"><?php echo $usuario->LastName ?></th>
                                            <th scope="col"><?php echo $usuario->Email ?></th>
                                            <th scope="col">
                                                <div class="form-check">
                                                    <?php if ($usuario->Status) : ?>
                                                        <input class="form-check-input form-control-lg" style="width:30px;margin-top: -24%;" disabled type="checkbox" checked id="defaultCheck1">
                                                    <?php else : ?>
                                                        <input class="form-check-input form-control-lg" style="width:30px;margin-top: -24%;" type="checkbox" id="defaultCheck1">
                                                    <?php endif; ?>
                                                </div>
                                            </th>
                                            <th scope="col">
                                                <div class="btn-group">
                                                    <a href="edit.php?id=<?php echo $usuario->Id ?>" class="btn text-white btn-sm btn-outline-secondary btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                    <a href="delete.php?id=<?php echo $usuario->Id ?>" class="btn text-white btn-sm btn-outline-secondary btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
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