<?php
require "classes/models/seller-model.php";
require "classes/models/product-model.php";
require "classes/views/secondhand-api.php";
require "controllers/controller.php";

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$sellerModel = new SellerModel();
$productModel = new ProductModel();
$secondhandApi = new SecondhandApi();
$controler = new Controller($secondhandApi, $method);
$controler->addRoute("/sellers", $sellerModel, "getAllSellers");
$controler->addRoute("/seller-id", $sellerModel, "getOneSeller");
$controler->addRoute("/seller", $sellerModel, "addSeller");
$controler->addRoute("/products", $productModel, "getAllProducts");
$controler->addRoute("/product/update", $productModel, "addSellingDate");
$controler->addRoute("/product", $productModel, "addProduct");
$controler->start($request);

// 