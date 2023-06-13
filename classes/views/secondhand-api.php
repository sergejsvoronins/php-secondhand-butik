<?php


class SecondhandApi
{
    public function outputJsonCollection(array $data) : void {
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

    public function outputJsonSingle(Object $data) : void {
            if($data instanceof Seller) {
                $json = [
                    "id" => $data->id,
                    "last_name" => $data->last_name,
                    "first_name" => $data->first_name,
                    "epost" => $data->epost,
                    "mobile" => $data->mobile,
                    "creating_date" => $data->creating_date,
                    "products_count" => $data->getProductsCount(),
                    "sold_products_count" => $data->getSoldProductsCount(),
                    "total_selling_price" =>$data->getTotalSellingPrice(),
                    "products_list" => $data->getProductsList()
                ];
            }
            else if($data instanceof Product) {
                $json = [
                    "id" => $data->id,
                    "name" => $data->name,
                    "size" => $data->getSize(),
                    "category" => $data->getCategory(),
                    "price" => $data->price,
                    "seller_ID" => $data->getSellerId(),
                    "seller_name" => $data->getSeller(),
                    "creating_date" => $data->creating_date,
                    "selling_date" => $data->selling_date,
                ];
            }
            else {
                http_response_code(400);
                $json = [
                    "message" => "Bad Request"
                ];
            }
            echo json_encode($json);
    }
    public function outputJsonValidationsError (array $errors) : void {
        http_response_code(422);
        echo json_encode(['errors' => $errors]);
    }
}