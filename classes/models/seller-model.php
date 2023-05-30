<?php
require_once "classes/db.php";
require "classes/seller.php";
class SellerModel extends DB {
    protected $table = "sellers";
    public function convertToSellerClass (array $ass_array) : array {
        $sellers = [];
        foreach ($ass_array as $element) {
            $seller = new Seller (
                $element["id"], 
                $element["first_name"], 
                $element["last_name"], 
                $element["epost"],
                $element["mobile"],
                $element["creating_date"]
            );
            array_push($sellers, $seller);
        }
        return $sellers;
    }
    public function getAllSellers () : array {
        $query = "SELECT * FROM $this->table ORDER BY $this->table.last_name ASC ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $this->convertToSellerClass($stmt->fetchAll()) ;   
    }
    public function getOneSeller (int $id) : array {
        $query = "SELECT * FROM $this->table WHERE $this->table.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $this->convertToSellerClass($stmt->fetchAll()) ;   
        }
    public function addSeller (Seller $seller) {
        $query = "INSERT INTO `sellers`(`first_name`, `last_name`, `epost`, `mobile`, `creating_date`) VALUES (?,?,?,?, CURRENT_DATE())";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$seller->first_name, $seller->last_name, $seller->epost, $seller->mobile, $seller->creating_date]);   
    }
    public function getProductsCountByUser (int $userId) {
        $query = "SELECT COUNT(s.id) FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ?
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        return $stmt->fetchAll();
    }
    public function getSoldProductsCountByUser (int $userId) {
        $query = "SELECT COUNT(s.id) FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ? AND p.selling_date IS NOT NULL
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        return $stmt->fetchAll();
    }
    public function getSoldProductsTotalPriceByUser (int $userId) {
        $query = "SELECT SUM(products.price) FROM sellers
                    JOIN products ON sellers.id = products.seller_id
                    WHERE sellers.id = ? AND products.selling_date IS NOT NULL
                    GROUP BY sellers.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        return $stmt->fetchAll();
    }
    public function getAllProductListByUser (int $userId) {
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