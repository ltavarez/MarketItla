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

if (isset($_POST['UserName']) && isset($_POST['Password']) && isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Email'])) {

    $newEntity = new User();
    $newEntity->InitializeData(0, $_POST['UserName'], $_POST['Password'], $_POST['FirstName'], $_POST['LastName'], $_POST['Email'], false);
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
            <a href="list.php" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver atrás</a> <b>Registra un nuevo usuario</b>
            </div>
            <div class="card-body">

                <form method="POST" action="add.php" enctype="multipart/form-data">

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputUserName">Nombre de usuario</label>
                            <input type="text" required name="UserName" class="form-control" id="InputUserName">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputPassword">Password</label>
                            <input type="password" required name="Password" class="form-control" id="InputPassword">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputFirstName">Primer Nombre</label>
                            <input type="text" required name="FirstName" class="form-control" id="InputFirstName">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputLastName">Primer Apellido</label>
                            <input type="text" required name="LastName" class="form-control" id="InputLastName">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="InputEmail">Correo</label>
                            <input type="email" required name="Email" class="form-control" id="InputEmail">

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Crear</button>
                </form>

            </div>
        </div>
    </div>
</main>
<?php $layout->printFooterAdministrator(); ?>