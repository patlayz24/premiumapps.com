<?php

namespace App\Controllers\Admin;

use App\Models\GameModel;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\ReportModel;

class Admin extends BaseController
{

    protected $transactionModel;
    protected $reportModel;
    protected $gameModel;
    public function __construct()
    {
        $this->gameModel = new GameModel();
        $this->transactionModel = new TransactionModel();
        $this->reportModel = new ReportModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'games' => $this->gameModel->getGames(),
            'transaction' => $this->transactionModel->getCountedData(),
            'totalTrx' => $this->reportModel->getCountedData(),
            'turnover' => $this->reportModel->getTurnOver(),
            'successTrx' => $this->reportModel->successTransaction(),
            'weekReports' => $this->reportModel->weekReport(),
            'popularProducts' => $this->reportModel->popularProduct(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/index', $data);
    }
}
