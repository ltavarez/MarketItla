<?php
//incluimos los archivos php que estaremos utilizando
include 'layout\layout.php';
include 'helpers\utilities.php';
include 'helpers/FileHandler/IFileHandler.php';
include 'helpers/FileHandler/SerializationFileHandler.php';
include 'helpers/FileHandler/JsonFileHandler.php';
include 'database/MarketItlaContext.php';
include 'user/User.php';
include 'database/repository/IRepository.php';
include 'database/repository/RepositoryBase.php';
include 'database/repository/RepositoryUser.php';
include 'user/UserService.php';

session_start();

$layout = new Layout(false);
$utilities = new Utilities();



$viewDetails = true;
$viewList = false;

$messageAuth = isset($_SESSION['messageAuth']) ? $_SESSION['messageAuth'] : "";

if (isset($_GET['view'])) {

    switch ($_GET['view']) {
        case "list":
            $viewDetails = false;
            $viewList = true;
            break;
        case "details":
            $viewDetails = true;
            $viewList = false;
            break;
        default:
            $viewDetails = true;
            $viewList = false;
            break;
    }
}

$_SESSION['messageAuth'] = "";



$filterName = "";

if (isset($_GET["name"])) {
    $filterName = $_GET["name"];
}

?>

    <?php $layout->printHeader(); ?>

    <main>

        <?php if ($messageAuth != "") : ?>

            <div class="alert alert-danger" role="alert">
                <?= $messageAuth; ?>
            </div>

        <?php endif; ?>

        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Productos</h1>
        </div>

        <div style="margin-top: 3%;" class="row">

            <div class="col-md-3">

                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Filtros
                    </div>
                    <div class="card-body">

                        <form method="GET" action="index.php">

                            <div class="form-group">
                                <label for="nameInput">Nombre</label>
                                <input type="text" value="<?php echo $filterName; ?>" name="name" class="form-control" id="nameInput">

                            </div>

                            <div class="form-group">
                                <label for="brandInput"> Marca </label>

                                <select name="brandId" class="form-control" id="brandInput">

                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary"> <i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                        </form>

                    </div>
                </div>

            </div>


            <div class="col-md-9">

                <div style="margin-bottom:2%;" class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3 ">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="index.php?view=list" type="button" class="btn btn-secondary"><i class="fa fa-list" aria-hidden="true"></i></a>
                            <a href="index.php?view=details" type="button" class="btn btn-secondary"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>

                        </div>

                    </div>
                </div>

                <?php if ($viewDetails == true) : ?>

                    <div class="row" style="margin-bottom:2%;">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:2%;">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php elseif ($viewList == true) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>

                <?php endif; ?>



            </div>

        </div>






    </main>


    <?php $layout->printFooter(); ?>