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
            $seller->addCreatingDate($element["creating_date"]);
            // $seller->addProductCount($this->getProductsCountByUser($element['id']));
            // $seller->addSoldProductCount($this->getSoldProductsCountByUser($element['id']));
            // $seller->addTotalSellingPrice($this->getSoldProductsTotalPriceByUser($element['id']));
            // $seller->addProducts($this->getAllProductListByUser($element['id']));
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
    // public function getOneSeller (int $id) : array {
    //     $query = "SELECT * FROM $this->table WHERE $this->table.id = ?";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute([$id]);
    //     return $this->convertToSellerClass($stmt->fetchAll());   
    //     }
    public function getOneSeller (int $id) : array {
        $query = "SELECT s.id, s.first_name, s.last_name, s.epost, s.mobile, s.creating_date, COUNT(s.id) AS sold_products_count, SUM(p.price) AS total_sold_products_price FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ? AND p.selling_date IS NOT NULL
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        $info = $stmt->fetchAll();
        $seller = $this->convertToSellerClass($info);
        $totalSoldProductsPrice = $info[0]["total_sold_products_price"];
        $SoldProductsCount = $info[0]["sold_products_count"];
        $productsCount  = $this->getProductsCountByUser($id);
        $products = $this->getAllProductListByUser($id);
        return [$seller,$totalSoldProductsPrice, $SoldProductsCount, $productsCount, $products]; 
    }
    public function addSeller (Seller $seller) : string {
        $query = "INSERT INTO `sellers`(`first_name`, `last_name`, `epost`, `mobile`, `creating_date`) VALUES (?,?,?,?, CURRENT_DATE())";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$seller->first_name, $seller->last_name, $seller->epost, $seller->mobile]);
        return $this->pdo->lastInsertId();  
    }
    public function getProductsCountByUser (int $userId) {
        $query = "SELECT COUNT(s.id) AS products_count FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ?
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        $array = $stmt->fetchAll();
        if (count($array)== 0) return 0;
        else {
            return $array[0]['products_count'];
        }
    }
    public function getSoldProductsCountByUser (int $userId) {
        $query = "SELECT COUNT(s.id) AS sold_products_count FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ? AND p.selling_date IS NOT NULL
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        $array = $stmt->fetchAll();
        if (count($array)== 0) return 0;
        else {
            return $array[0]['sold_products_count'];
        }
    }
    public function getSoldProductsTotalPriceByUser (int $userId) {
        $query = "SELECT SUM(products.price) AS total_price FROM sellers
                    JOIN products ON sellers.id = products.seller_id
                    WHERE sellers.id = ? AND products.selling_date IS NOT NULL
                    GROUP BY sellers.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        $array = $stmt->fetchAll();
        if (count($array)== 0) return 0;
        else {
            return (int) $array[0]['total_price'];
        }
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