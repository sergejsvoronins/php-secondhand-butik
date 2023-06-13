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
            $product->addSize($element["size"] ?? "");
            $product->addCategory($element["category"] ?? "");
            $product->addSeller($element["seller"] ?? "");
            array_push($products, $product);
        }
        return $products;
    }
    public function getAllProducts () : array {
        return $this->convertToProductClass($this->getAll($this->table));
    }
    public function getOneProduct (int $id)  {
        $query = "SELECT p.*, sizes.name AS size, c.name AS category, CONCAT(s.first_name, ' ', s.last_name) AS seller FROM products AS p
        JOIN sizes ON p.size_id = sizes.id
        JOIN categories AS c ON p.category_id=c.id
        JOIN sellers AS s ON p.seller_id = s.id 
        WHERE p.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $this->convertToProductClass($stmt->fetchAll());
    }
    public function addProduct (Product $product) : string {
        $query = "INSERT INTO `products`(`name`, `size_id`, `category_id`, `price`, `seller_id`) 
                    VALUES (?,?,?,?,?);";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$product->name, $product->getSizeId(), $product->getCategoryId(), $product->price, $product->getSellerId()]);
        return $this->pdo->lastInsertId();
    }
    public function addSellingDate (int $productId) : int {
        $query ="UPDATE products  SET selling_date= IF(selling_date IS NULL, CURRENT_TIMESTAMP(), selling_date)
        WHERE id = ?;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$productId]);  
        return $stmt->rowCount();
    }
}