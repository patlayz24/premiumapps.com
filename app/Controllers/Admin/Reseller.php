<?php

namespace App\Controllers\Admin;

use App\Models\ResellerModel;
use App\Models\ResellerBillModel;
use App\Controllers\BaseController;

class Reseller extends BaseController
{
    protected $resellerModel;
    protected $resellerBillModel;
    public function __construct()
    {
        $this->resellerModel = new ResellerModel();
        $this->resellerBillModel = new ResellerBillModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Reseller Account',
            'resellers' => $this->resellerModel->getUsers(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/reseller', $data);
    }

    public function register()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'full_name' => 'required|min_length[3]|max_length[30]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[reseller.email]',
                'password' => 'required|min_length[8]|max_length[255]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/reseller');
            } else {
                $newData = [
                    'full_name' => htmlspecialchars($this->request->getVar('full_name')),
                    'email' => htmlspecialchars($this->request->getVar('email')),
                    'phone' => htmlspecialchars($this->request->getVar('phone')),
                    'address' => htmlspecialchars($this->request->getVar('address')),
                    'status' => 0,
                    'password' => htmlspecialchars($this->request->getVar('password')),
                    'updated_by' => session('full_name'),
                ];

                $this->resellerModel->save($newData);
                session()->setFlashdata('success', 'Data berhasil ditambah.');
                return redirect()->to(base_url('admin/reseller'));
            }
        }
    }

    public function setActive($id)
    {
        if ($this->request->getMethod() == 'put') {
            $this->resellerModel->save([
                'id_reseller' => $id,
                'status' => htmlspecialchars($this->request->getVar('setactive')),
                'updated_by' => session()->get('full_name'),
            ]);
            session()->setFlashdata('success', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/reseller'));
        }
    }
    public function setLunas($id)
    {
        if ($this->request->getMethod() == 'put') {

            $data = [
                'transaction_number' => $id,
                'status' => htmlspecialchars($this->request->getVar('setactive')),
                'updated_by' => session()->get('full_name'),
            ];
            $this->resellerBillModel->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/reseller/payment'));
        }
    }

    public function deleteReseller($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->resellerModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/reseller'));
        }
    }

    public function detail($id)
    {
        $data = [
            'reseller' => $this->resellerModel->getUsers($id)
        ];
        return view('admin/modal/detail/detailreseller', $data);
    }

    public function payment()
    {
        $data = [
            'title' => 'Reseller Payment',
            'request' => \Config\Services::request(),
            'payments' => $this->resellerBillModel->getAllBill()
        ];
        return view('admin/resellerpayment', $data);
    }

    public function paymentDetail()
    {
        return view('admin/respaymentDetail');
    }
}
