<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\GameModel;
use App\Models\ProductModel;

class Product extends BaseController
{
    protected $gameModel;
    protected $productModel;
    public function __construct()
    {
        $this->gameModel = new GameModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Products',
            'request' => \Config\Services::request(),
            'games' => $this->gameModel->getGames(),
            'products' => $this->productModel->getProductName(),
        ];
        return view('reseller/product', $data);
    }
}
