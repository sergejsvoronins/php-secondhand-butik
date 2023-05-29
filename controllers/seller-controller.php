<?php

class SellerController {
    
    private $model = null;
    private $view = null;

    public function __construct($sellerModel, $sellerView)
    {
        $this->model = $sellerModel;
        $this->view = $sellerView;
    }

    public function start($request)
    {
        if($request == "/project/sellers") {
            $this->view->outputAll($this->model->getAllSellers());
        }
    }
}