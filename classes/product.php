<?php
class Product {
    public int | null $id = null;
    public string $name = "";
    private int $size_id = 0;
    private int $category_id = 0;
    public int $price = 0;
    private int $seller_id = 0;
    public string $creating_date = "";
    public string | null $selling_date = "";

    private string $size = "";
    private string $category = "";
    private string $seller = "";

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
    public function addCreatingDate (string $date) : void {
        $this->creating_date = $date;
    }
    public function addSellingDate (string | null $date) : void {
        $this->selling_date = $date;
    }
    public function addSize (? string  $size) : void {
        $this->size = $size;
    }
    public function addCategory ( ? string $category) : void {
        $this->category = $category;
    }
    public function addSeller ( ? string $seller) : void {
        $this->seller = $seller;
    }
    public function addSellerId ( int $sellerId) : void {
        $this->seller_id = $sellerId;
    }
    public function addSizeId ( int $sizeId) : void {
        $this->size_id = $sizeId;
    }
    public function addCategoryId ( int $categoryId) : void {
        $this->category_id = $categoryId;
    }
    public function getSize () : string{
        return $this->size;
    }
    public function getCategory () :string {
        return $this->category;
    }
    public function getSeller () :string {
        return $this->seller;
    }
    public function getSellerId () : int {
        return $this->seller_id;
    }
    public function getSizeId () : int {
        return $this->size_id;
    }
    public function getCategoryId () : int {
        return $this->category_id;
    }

}