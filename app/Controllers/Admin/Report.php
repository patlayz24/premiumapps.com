<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReportModel;


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
            'reports' => $this->reportModel->getReport(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/report', $data);
    }

    public function detail($id)
    {
        $data = [
            'report' => $this->reportModel->getReport($id),
        ];
        return view('admin/modal/detail/detailreport', $data);
    }
}
