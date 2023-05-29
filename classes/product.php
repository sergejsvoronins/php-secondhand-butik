<?php
class Product {
    public int $id = 0;
    public string $name = "";
    public int $size_id = 0;
    public int $category_id = 0;
    public int $price = 0;
    public int $seller_id = 0;
    public string $creating_date = "";
    public string | null $seller_date = "";

    function __construct($id, $name, $size_id, $category_id, $price, $seller_id, $creating_date,$seller_date) {
        $this->id = $id;
        $this->name = $name;
        $this->size_id = $size_id;
        $this->category_id = $category_id;
        $this->price = $price;
        $this->seller_id = $seller_id;
        $this->creating_date = $creating_date;
        $this->seller_date = $seller_date;
    }
}