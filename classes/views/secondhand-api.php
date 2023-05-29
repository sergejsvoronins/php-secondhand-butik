<?php


class SecondhandApi
{
    public function outputAll (array $array) {
        $json = [
            "student-count" => count($array),
            "result" => $array
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }
}