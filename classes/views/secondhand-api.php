<?php


class SecondhandApi
{
    public function outputJsonCollection(array $data) {
        if(count($data)==0){
            http_response_code(400);
        }
        else {
            $json = [            
                "count" => count($data),
                "result" => $data
            ];
            echo json_encode($json);
        }
    }
    public function outputJsonSingleSeller(array $data) {
        if(count($data)==0){
            http_response_code(400);
        }
        else {
            $json = [
                "seller_info" => $data[0],
                "total_sold_products_price" => $data[1],
                "sold_products_count" => $data[2],
                "products_count" => $data[3],
                "products" => $data[4],

            ];
            echo json_encode($json);

        }
    }
    public function outputJsonSingle(array $data) {
        if(count($data)==0){
            http_response_code(400);
        }
        else {
            $json = [
                "seller_info" => $data[0],
                "total_sold_products_price" => $data[1],
                "sold_products_count" => $data[2],
                "products_count" => $data[3],
                "products" => $data[4],

            ];
            echo json_encode($json);

        }
    }
    public function outputJsonValidationsError (array $errors) {
        http_response_code(422);
        echo json_encode(['errors' => $errors]);
    }
}