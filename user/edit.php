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

$containId = isset($_GET['id']);
$element = null;

if ($containId) {
    $id = $_GET['id'];
    $element = $service->GetById($id);

    if (isset($_POST['Status'])) {
        $status = $_POST['Status'] == true ? true : false;
    } else {
        $status = false;
    }
}

if (isset($_POST['UserName']) && isset($_POST['Password']) && isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Email'])) {

    $updateEntity = new User();
    $updateEntity->InitializeData($id, $_POST['UserName'], $_POST['Password'], $_POST['FirstName'], $_POST['LastName'], $_POST['Email'], $status);
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
                    <a href="list.php" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver atrás</a> <strong> Editando el usuario <?php echo $element->FirstName . " " . $element->LastName;  ?></strong>
                </div>
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="edit.php?id=<?php echo $element->Id ?>">

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputUserName">Nombre de usuario</label>
                                <input required type="text" value="<?php echo $element->UserName; ?>" required name="UserName" class="form-control" id="InputUserName">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputPassword">Password</label>
                                <input required type="password" value="<?php echo $element->Password; ?>" required name="Password" class="form-control" id="InputPassword">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputFirstName">Primer Nombre</label>
                                <input required type="text" value="<?php echo $element->FirstName; ?>" required name="FirstName" class="form-control" id="InputFirstName">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputLastName">Primer Apellido</label>
                                <input required type="text" value="<?php echo $element->LastName; ?>" required name="LastName" class="form-control" id="InputLastName">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="InputEmail">Correo</label>
                                <input required type="email" value="<?php echo $element->Email; ?>" required name="Email" class="form-control" id="InputEmail">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CheckStatus">
                                    Estado
                                </label>

                                <?php if ($element->Status) : ?>
                                    <input class="form-check-input form-control-lg" style="width:30px;margin-top: -2%;margin-left: 3%;" name="Status" checked type="checkbox" value="true" id="CheckStatus">
                                <?php else : ?>
                                    <input class="form-check-input form-control-lg" style="width:30px;margin-top: -2%;margin-left: 3%;" name="Status" type="checkbox" value="true" id="CheckStatus">
                                <?php endif; ?>



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