<?php

class Controller {
    private $routes = [];
    private $view = null;

    public function __construct($view) {
        $this->view = $view;
    }

    public function addRoute($route, $model, $method) {
        $this->routes[$route] = ['model' => $model, 'method' => $method];
    }

    public function start($method, $request) {
        $url = parse_url($request, PHP_URL_PATH);
        var_dump($url);
        foreach ($this->routes as $route => $action) {
            if ($method =="GET" && strpos($url, $route) === 8) {
                $params = trim(substr($url, strlen($route)), '/');
                $paramsArray = explode('/', $params);
                // var_dump($paramsArray);
                $model = $action['model'];
                $method = $action['method'];

                $this->handleGetRoute($model, $method, $paramsArray);
                return;
            }
            else if ($method =="POST" && strpos($url, $route) === 8){
                $params = trim(substr($url, strlen($route)), '/');
                $paramsArray = explode('/', $params);
                // var_dump($paramsArray);
                $model = $action['model'];
                $method = $action['method'];
                $this->handlePostRoute($model, $method, $paramsArray);
                return;
            }
        }

        // If no route matches, return an error or appropriate response
        $this->view->outputJson([]);
        // $this->view->outputJson(['error', 'Route not found']);
    }

    private function handleGetRoute($model, $method, $paramsArray) {
        if (count($paramsArray) === 1) {
            $this->view->outputJson($model, $model->$method());
        } else if (count($paramsArray) === 2) {
            $this->view->outputJson($model, $model->$method((int)$paramsArray[1]));
        } else {
            // If the route expects more than one parameter, you can handle it accordingly
            // $this->view->outputJson('error', 'Invalid route');
        }
    }
    private function handlePostRoute ($model, $method, $paramsArray){
        $requestData = $_POST;
        if(count($paramsArray) === 1){
            $product = new Product (
                $requestData["name"],
                $requestData["size_id"],
                $requestData["category_id"],
                $requestData["price"],
                $requestData["seller_id"]
            );
            $model->$method($product);
        }
    }
}
