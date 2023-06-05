<?php


class SecondhandApi
{
    public function outputJson ($input) {
        $json = [            
            "count" => count($input),
            "result" => $input
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }
}