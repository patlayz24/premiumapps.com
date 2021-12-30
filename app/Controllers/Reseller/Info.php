<?php

namespace App\Controllers\Reseller;

use App\Controllers\BaseController;
use App\Models\InfoModel;

class Info extends BaseController
{
    protected $infoModel;
    public function __construct()
    {
        $this->infoModel = new InfoModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Informasi',
            'request' => \Config\Services::request(),
            'informations' => $this->infoModel->getInformations(),
        ];
        return view('reseller/info', $data);
    }
}
