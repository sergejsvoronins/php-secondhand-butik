<?php


class SecondhandApi
{
    public function outputJson(array $data) {
        header("Content-Type: application/json");
        if(count($data)==0){
            http_response_code(400);
        }
        if(count($data)>1){
            $json = [            
                "count" => count($data),
                "result" => $data
            ];
            echo json_encode($json);
        }
        else {
            echo json_encode($data);
        }
    }
    public function outputJsonValidationsError (array $errors) {
        http_response_code(422);
        echo json_encode(['errors' => $errors]);
    }
}