<?php
require_once "classes/db.php";
require "classes/product.php";
class ProductModel extends DB {
    protected $table = "products";
    public function convertToProductClass (array $ass_array) : array {
        $products = [];
        foreach ($ass_array as $element) {
            $product = new Product (
                $element["id"], 
                $element["name"], 
                $element["size_id"], 
                $element["category_id"], 
                $element["price"], 
                $element["seller_id"], 
                $element["creating_date"],
                $element["selling_date"]
            );
            array_push($products, $product);
        }
        return $products;
    }
    public function getAllProducts () : array {
        return $this->convertToProductClass($this->getAll($this->table));
    }
}