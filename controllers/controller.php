<?php

class Controller {
    private $routes = [];
    private $view = null;
    private $method = "";

    public function __construct($view, $method) {
        $this->view = $view;
        $this->method = $method;
    }

    public function addRoute($route, $model, $method, $requestType) {
        $data = [
            [
                'route' => $route,
                'model' => $model,
                'method' => $method,
                'request_type' => $requestType
            ]
        ];
        array_push($this->routes, $data);
    }

    public function start($request):void {
        $parts = explode("/", $request);
        foreach ($this->routes as $route) {
            if($this->method == "GET" && trim($route[0]["route"], "/") == $parts[2] && $route[0]['request_type'] == "GET") {
                $id = $parts[3] ?? NULL;
                $model = $route[0]['model'];
                $method = $route[0]['method'];
                $this->handleGetRoute($model, $method, $id);
            }
            else if($this->method == "POST" && trim($route[0]['route'], "/") == $parts[2] && $route[0]['request_type'] == "POST") {
                $model = $route[0]['model'];
                $method = $route[0]['method']; 
                $this->handlePostRoute($model, $method, $parts[2]);
            }
            else if($this->method == "PUT" && trim($route[0]['route'], "/") == $parts[2] && $route[0]['request_type'] == "PUT") {
                $id = $parts[3] ?? null;
                $model = $route[0]['model'];
                $method = $route[0]['method'];
                $this->handlePutRoute($model, $method, $id);
            }
        }
    }
    
    private function handleGetRoute($model, $method, ? string $id) {
        if ($id) {
            $errors = $this->getValidationErrors(["id" => $id]);
            if(! empty($errors)) {
                $this->view->outputJsonValidationsError($errors);
            }
            else {
                // echo json_encode($model->$method((int)$id));
                // var_dump($model->$method((int)$id));
                $this->view->outputJsonSingle($model->$method((int)$id));
            }
        } else {
            $this->view->outputJsonCollection($model->$method());
        } 
    }
    private function handlePostRoute ($model, $method, $element){
        $data = file_get_contents('php://input');
        $requestData = json_decode($data, true);
        $id = null;
            switch($element) {
                case ("seller"):
                    $requestData["first_name"] = filter_var($requestData["first_name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["last_name"] = filter_var($requestData["last_name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["epost"] = filter_var($requestData["epost"],FILTER_SANITIZE_EMAIL);
                    $requestData["mobile"] = filter_var($requestData["mobile"],FILTER_SANITIZE_NUMBER_INT);
                    $errors = $this->getValidationErrors($requestData);
                    if(! empty($errors)){
                        $this->view->outputJsonValidationsError($errors);
                    }
                    else {
                        $seller = new Seller (
                            $requestData["first_name"], 
                            $requestData["last_name"], 
                            $requestData["epost"], 
                            $requestData["mobile"]);
                        $id = $model->$method($seller);
                    }
                    break;
                case ("product"):
                    $requestData["name"] = filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["size_id"] = filter_var($requestData["size_id"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["category_id"] = filter_var($requestData["category_id"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["price"] = filter_var($requestData["price"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["seller_id"] = filter_var($requestData["seller_id"],FILTER_SANITIZE_NUMBER_INT);
                    $errors = $this->getValidationErrors($requestData);
                    if(! empty($errors)){
                        $this->view->outputJsonValidationsError($errors);
                    }
                    else {
                        $product = new Product (
                            $requestData["name"], 
                            (int) $requestData["size_id"], 
                            (int) $requestData["category_id"], 
                            (int) $requestData["price"], 
                            (int) $requestData["seller_id"]);
                        $id = $model->$method($product);
                    }
                    break;
        }
        if($id){
            http_response_code(201);
            echo json_encode([
                "message" => "$element is created",
                "id" => $id
            ]);
        }
        
    }
    private function handlePutRoute ($model, $method, ? string $id){
        if($id) {
            $errors = $this->getValidationErrors(["id" => $id]);
            if(! empty($errors)) {
                $this->view->outputJsonValidationsError($errors);
            }
            else {
            $isSold = $model->$method((int)$id);
                if($isSold!=0){
                echo json_encode([
                    "message" => "Product  med ID = $id has been updated"
                ]);
                }
                else {
                echo json_encode([
                    "message" => "Product  med ID = $id is already sold"
                ]);
                
                }
            }
        }
    }


    private function getValidationErrors($data) : array {
        $errors = [];
        if(is_array($data) && ! empty($data)){
            foreach($data as $element => $value) {
                if(empty($value)) {
                    $errors [] = $element . " is required";
                }
            }
            if(array_key_exists("id", $data)) {
                if(filter_var($data["id"],FILTER_VALIDATE_INT)=== false) {
                    $errors [] = "Id must be of type number";
                }
            }
            if(array_key_exists("epost", $data)) {
                if(filter_var($data["epost"],FILTER_VALIDATE_EMAIL)=== false) {
                    $errors [] = "Epost must be type of epost";
                }
            }
            if(array_key_exists("size_id", $data)) {
                if(filter_var($data["size_id"],FILTER_VALIDATE_INT)=== false) {
                    $errors [] = "Size must be type of integer";
                }
            }
            if(array_key_exists("category_id", $data)) {
                if(filter_var($data["category_id"],FILTER_VALIDATE_INT)=== false) {
                    $errors [] = "Category must be type of integer";
                }
            }
            if(array_key_exists("price", $data)) {
                if(filter_var($data["price"],FILTER_VALIDATE_INT)=== false) {
                    $errors [] = "Price must be type of integer";
                }
            }
            if(array_key_exists("seller_id", $data)) {
                if(filter_var($data["seller_id"],FILTER_VALIDATE_INT)=== false) {
                    $errors [] = "Price must be type of integer";
                }
            }
            return $errors;
        }
        else {
            http_response_code(422);
            return $errors;
        }
    }
}
