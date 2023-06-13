<?php
class Seller {
    public  $id = 0;
    public string $first_name = "";
    public string $last_name = "";
    public string $epost = "";
    public string $mobile = "";
    public string $creating_date = "";

    private  $productsCount = 0;
    private  $soldProductsCount = 0;
    private $totalSellingPrice = 0;
    private $productsList = [];


    function __construct(
        $first_name, 
        $last_name, 
        $epost, 
        $mobile, 
        ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->epost = $epost;
        $this->mobile = $mobile;
    }
    public function adId(int $id) {
        $this->id = $id;
    }
    public function addCreatingDate (string $date) {
        $this->creating_date = $date;
    }
    public function addProductCount (int $count) {
        $this->productsCount = $count;
    }
    public function addSoldProductCount (int $count) {
        $this->soldProductsCount = $count;
    }
    public function addTotalSellingPrice (int $totalPrice) {
        $this->totalSellingPrice = $totalPrice;
    }
    public function addProducts (array $productsList) {
        $this->productsList = $productsList;
    }
    public function getProductsCount () {
        return $this->productsCount;
    }
    public function getSoldProductsCount () {
        return $this->soldProductsCount;
    }
    public function getTotalSellingPrice () {
        return $this->totalSellingPrice;
    }
    public function getProductsList () {
        return $this->productsList;
    }
}