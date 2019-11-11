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


$service = new BrandService("../database");

$containId = isset($_GET['id']); 
$Id = 0;
if ($containId) {
    $Id = $_GET['id']; 
    $service->Delete($Id);
}

 header("Location: list.php"); 
 exit(); 
?>