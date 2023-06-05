<?php

class Controller {
    private $routes = [];
    private $view = null;
    private $method = "";

    public function __construct($view, $method) {
        $this->view = $view;
        $this->method = $method;
    }

    public function addRoute($route, $model, $method) {
        $this->routes[$route] = ['model' => $model, 'method' => $method];
    }

    public function start($request):void {
        $parts = explode("/", $request);
            foreach ($this->routes as $route => $action) {
            if($this->method == "GET" && trim($route, "/") == $parts[2]) {
                $id = $parts[3] ?? null;
                $model = $action['model'];
                $method = $action['method'];
                $this->handleGetRoute($model, $method, $id);
            }
            else if($this->method == "POST" && trim($route, "/") == $parts[2]) {
                $model = $action['model'];
                $method = $action['method']; 
                $this->handlePostRoute($model, $method, $parts[2]);
            }
            else if($this->method == "PUT" && trim($route, "/") == $parts[2] . "/" . $parts[3]) {
                $id = $parts[4] ?? null;
                $model = $action['model'];
                $method = $action['method'];
                $this->handlePutRoute($model, $method, $id);
            }
        }
        
        // $this->view->outputJson("error");
        // http_response_code(404);
    }
    
    private function handleGetRoute($model, $method, ? int $id) {
        if ( $id) {
            $this->view->outputJson($model->$method($id));
        } else {
            $this->view->outputJson($model->$method());
        } 
    }
    private function handlePostRoute ($model, $method, $element){
        $requestData = $_POST;
        if(isset(
            $_POST["first_name"],
            $_POST["last_name"],
            $_POST["epost"],
            $_POST["mobile"],
        ) || isset(
            $_POST["name"],
            $_POST["size_id"],
            $_POST["category_id"],
            $_POST["price"],
            $_POST["seller_id"],
        ))  {
            switch($element) {
                case ("seller"):
                    $fname = filter_var($requestData["first_name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $lname = filter_var($requestData["last_name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $epost = filter_var(filter_var($requestData["epost"],FILTER_SANITIZE_EMAIL),FILTER_VALIDATE_EMAIL);
                    $mobile = filter_var($requestData["mobile"],FILTER_SANITIZE_NUMBER_INT);
                    $seller = new Seller ($fname, $lname, $epost, $mobile);
                    $id = $model->$method($seller);
                    break;
                case ("product"):
                    $name = filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $size = filter_var(filter_var($requestData["size_id"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT);
                    $category = filter_var(filter_var($requestData["category_id"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT);
                    $price = filter_var(filter_var($requestData["price"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT);
                    $seller = filter_var(filter_var($requestData["seller_id"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT);
                    $product = new Product ($name, $size, $category, $price, $seller);
                    $id = $model->$method($product);
                    break;
            }
            http_response_code(201);
            echo json_encode([
                "message" => "$element is created",
                "id" => $id
            ]);
        }      
    }
    private function handlePutRoute ($model, $method, ? string $id){
        if($id) {
            $model->$method((int)$id);
        }
    }
}
