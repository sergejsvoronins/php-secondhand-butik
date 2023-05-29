<?php
require "classes/models/seller-model.php";
require "classes/models/category-model.php";
require "classes/models/size-model.php";
require "classes/models/product-model.php";
require "classes/views/secondhand-api.php";
require "controllers/seller-controller.php";

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


$productModel = new ProductModel();
$categoryModel = new CategoryModel();
$sizeModel = new SizeModel();
$sellerModel = new SellerModel();
$secondhandApi = new SecondhandApi();
$sellerController = new SellerController($sellerModel, $secondhandApi);
if ($method == 'GET') {
    $sellerController->start($request);
}