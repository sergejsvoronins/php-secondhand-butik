<?php


class SecondhandApi
{
    public function outputJson ($input) {
        // var_dump($model);
        if($input== "error") {
            echo "Route is not found";
        }
        else {
            $json = [            
                "count" => count($input),
                "result" => $input
            ];
    
    
            header("Content-Type: application/json");
            echo json_encode($json);
        }
    }
}