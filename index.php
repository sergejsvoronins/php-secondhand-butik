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
$controler->addRoute("sellers", $sellerModel, "getAllSellers", "GET");
$controler->addRoute("seller/", $sellerModel, "getOneSeller", "GET");
$controler->addRoute("seller", $sellerModel, "addSeller", "POST");
$controler->addRoute("products", $productModel, "getAllProducts", "GET");
$controler->addRoute("product/", $productModel, "addSellingDate", "PUT");
$controler->addRoute("product", $productModel, "addProduct", "POST");
$controler->start($request);

// 