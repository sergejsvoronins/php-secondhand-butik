<?php
class Product {
    public int | null $id = null;
    public string $name = "";
    public int $size_id = 0;
    public int $category_id = 0;
    public int $price = 0;
    public int $seller_id = 0;
    public string $creating_date = "";
    public string | null $selling_date = "";

    function __construct($name, $size_id, $category_id, $price, $seller_id) {
        $this->name = $name;
        $this->size_id = $size_id;
        $this->category_id = $category_id;
        $this->price = $price;
        $this->seller_id = $seller_id;
    }
    public function addId (int $id) {
        $this->id = $id;
    }
    public function addCreatingDate (string $date) {
        $this->creating_date = $date;
    }
    public function addSellingDate (string | null $date) {
        $this->selling_date = $date;
    }
}