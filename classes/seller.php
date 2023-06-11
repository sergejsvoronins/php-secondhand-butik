<?php
class Seller {
    public  $id = 0;
    public string $first_name = "";
    public string $last_name = "";
    public string $epost = "";
    public string $mobile = "";
    public string $creating_date = "";

    // public  $productsCount = 0;
    // public  $soldProductsCount = 0;
    // public $totalSellingPrice = 0;
    // public $products = [];


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
    // public function addProductCount (int $count) {
    //     $this->productsCount = $count;
    // }
    // public function addSoldProductCount (int $count) {
    //     $this->soldProductsCount = $count;
    // }
    // public function addTotalSellingPrice (int $totalPrice) {
    //     $this->totalSellingPrice = $totalPrice;
    // }
    // public function addProducts (array $products) {
    //     $this->products = $products;
    // }
}