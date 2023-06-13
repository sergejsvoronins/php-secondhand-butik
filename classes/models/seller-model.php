<?php
require_once "classes/db.php";
require "classes/seller.php";
class SellerModel extends DB {
    protected $table = "sellers";
    public function convertToSellerClass (array $ass_array) : array {
        $sellers = [];
        foreach ($ass_array as $element) {
            $seller = new Seller (
                $element["first_name"], 
                $element["last_name"], 
                $element["epost"],
                $element["mobile"],
            );
            $seller->adId($element["id"]);
            $seller->addCreatingDate($element["creating_date"] ?? 0);
            $seller->addProductCount($element["products_count"] ?? 0);
            $seller->addSoldProductCount($element["sold_products_count"] ?? 0);
            $seller->addTotalSellingPrice($element["total_sold_products_price"] ?? 0);
            $seller->addProducts($this->getAllProductListByUser($element['id']));
            array_push($sellers, $seller);
        }
        return $sellers;
    }
    public function getAllSellers () : array {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $this->convertToSellerClass($stmt->fetchAll()) ;   
    }
    public function getOneSeller (int $id) : array {
        $query = "SELECT s.id, s.first_name, s.last_name, s.epost, s.mobile, s.creating_date, COUNT(p.id) AS products_count,  
                    COUNT(CASE WHEN p.selling_date IS NOT NULL THEN p.id ELSE NULL END) AS sold_products_count,
                    SUM(CASE WHEN p.selling_date IS NOT NULL THEN p.price ELSE 0 END) AS total_sold_products_price
                    FROM sellers AS s
                    LEFT JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ?
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $this->convertToSellerClass($stmt->fetchAll());
    }
    public function addSeller (Seller $seller) : string {
        $query = "INSERT INTO `sellers`(`first_name`, `last_name`, `epost`, `mobile`, `creating_date`) VALUES (?,?,?,?, CURRENT_DATE())";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$seller->first_name, $seller->last_name, $seller->epost, $seller->mobile]);
        return $this->pdo->lastInsertId();  
    }
    public function getAllProductListByUser (int $userId) : array {
        $query = "SELECT products.id, products.name, sizes.name AS size, categories.name AS category, products.price, products.creating_date, products.selling_date FROM sellers
                    JOIN products ON sellers.id = products.seller_id
                    JOIN sizes ON sizes.id = products.size_id
                    JOIN categories ON categories.id = products.category_id
                    WHERE sellers.id = ?;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        return $stmt->fetchAll();
    }
}