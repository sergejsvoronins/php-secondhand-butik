<?php
require_once "classes/db.php";
require "classes/product.php";
class ProductModel extends DB {
    protected $table = "products";
    public function convertToProductClass (array $ass_array) : array {
        $products = [];
        foreach ($ass_array as $element) {
            $product = new Product (
                $element["name"], 
                $element["size_id"], 
                $element["category_id"], 
                $element["price"], 
                $element["seller_id"], 
            );
            $product->addId($element["id"]);
            $product->addCreatingDate($element["creating_date"]);
            $product->addSellingDate($element["selling_date"]);
            array_push($products, $product);
        }
        return $products;
    }
    public function getAllProducts () : array {
        return $this->convertToProductClass($this->getAll($this->table));
    }
    public function addProduct (Product $product) : string {
        $query = "INSERT INTO `products`(`name`, `size_id`, `category_id`, `price`, `seller_id`, `creating_date`) 
                    VALUES (?,?,?,?,?,CURRENT_DATE());";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$product->name, $product->size_id, $product->category_id, $product->price, $product->seller_id]);
        return $this->pdo->lastInsertId();
    }
    public function addSellingDate (int $productId) {
        $query ="UPDATE `products` SET `selling_date`= CURRENT_DATE() WHERE products.id = ?;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$productId]);  
    }
}