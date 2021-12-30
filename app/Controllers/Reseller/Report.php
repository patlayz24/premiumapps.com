<?php

namespace App\Controllers\Reseller;

use App\Models\ReportModel;
use App\Controllers\BaseController;

class Report extends BaseController
{
    protected $reportModel;

    public function __construct()
    {
        $this->reportModel = new ReportModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Report',
            'request' => \Config\Services::request(),
            'reports' => $this->reportModel->getReportReseller(),
        ];
        return view('reseller/report', $data);
    }
}
