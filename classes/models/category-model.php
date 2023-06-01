<?php
// require_once "classes/db.php";
// require "classes/category.php";
// class CategoryModel extends DB {
//     protected $table = "categories";
//     public function convertToCategoryClass (array $ass_array) : array {
//         $categories = [];
//         foreach ($ass_array as $element) {
//             $category = new Category (
//                 $element["id"], 
//                 $element["name"], 
//                 $element["creating_date"]
//             );
//             array_push($categories, $category);
//         }
//         return $categories;
//     }
//     public function getAllCategories () : array {
//         return $this->convertToCategoryClass($this->getAll($this->table));
//     }
// }