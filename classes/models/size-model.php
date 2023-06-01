<?php
// require_once "classes/db.php";
// require "classes/size.php";
// class SizeModel extends DB {
//     protected $table = "sizes";
//     public function convertToSizeClass (array $ass_array) : array {
//         $sizes = [];
//         foreach ($ass_array as $element) {
//             $size = new Size (
//                 $element["id"], 
//                 $element["name"], 
//                 $element["description"], 
//                 $element["creating_date"]
//             );
//             array_push($sizes, $size);
//         }
//         return $sizes;
//     }
//     public function getAllSizes () : array {
//         return $this->convertToSizeClass($this->getAll($this->table));
//     }
// }