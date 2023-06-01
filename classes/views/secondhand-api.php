<?php


class SecondhandApi
{
    public function outputJson ($model, $method) {
        // var_dump($model);
        $json = [            
            "count" => count($method),
            "result" => $method
        ];


        header("Content-Type: application/json");
        echo json_encode($json);
    }
}