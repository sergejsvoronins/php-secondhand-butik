<?php


class SecondhandApi
{
    public function outputAll (string $unit, array $array) {
        $json = [
            "$unit-count" => count($array),
            "result" => $array
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }
}