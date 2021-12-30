<?php

namespace App\Controllers\Reseller;

use App\Models\TransactionModel;
use App\Controllers\BaseController;

class Pesanan extends BaseController
{
    protected $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Pesanan',
            'request' => \Config\Services::request(),
            'transactions' => $this->transactionModel->getDataReseller(),
        ];
        return view('reseller/pesanan', $data);
    }
}
