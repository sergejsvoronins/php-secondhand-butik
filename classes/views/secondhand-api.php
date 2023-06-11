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
    public function outputJsonSingle(array $data) {
        if(count($data)==0){
            http_response_code(400);
        }
        else {
            $json = [
                "info" => $data,
                "products_count" => $data
            ];
            echo json_encode($json);
        }
    }
    public function outputJsonValidationsError (array $errors) {
        http_response_code(422);
        echo json_encode(['errors' => $errors]);
    }
}