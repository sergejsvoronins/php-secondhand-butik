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
        return $this->convertToSellerClass($this->getAll($this->table));
    }
}