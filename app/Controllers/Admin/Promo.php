<?php

namespace App\Controllers\Admin;

use App\Models\GameModel;
use App\Models\PromoModel;
use App\Controllers\BaseController;

class Promo extends BaseController
{
    protected $promoModel;

    public function __construct()
    {
        $this->promoModel = new PromoModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kode Promo',
            'promos' => $this->promoModel->getPromo(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/promo', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'promo_name' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/promo');
            } else {
                $this->promoModel->save([
                    'promo_name' => htmlspecialchars($this->request->getVar('promo_name')),
                    'promo_code' => htmlspecialchars($this->request->getVar('promo_code')),
                    'discount' => htmlspecialchars($this->request->getVar('discount')),
                    'stock' => htmlspecialchars($this->request->getVar('stock')),
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/promo'));
            }
        }
    }

    public function detail($getData)
    {
        $data = [
            'promos' => $this->promoModel->getPromo($getData),
        ];
        return view('admin/modal/edit/promo', $data);
    }

    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'promo_name' => 'required',
                'promo_code' => 'required',
                'discount' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/promo');
            } else {
                $this->promoModel->save([
                    'id' => $id,
                    'promo_name' => htmlspecialchars($this->request->getVar('promo_name')),
                    'promo_code' => htmlspecialchars($this->request->getVar('promo_code')),
                    'discount' => htmlspecialchars($this->request->getVar('discount')),
                    'stock' => htmlspecialchars($this->request->getVar('stock')),
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('admin/promo'));
            }
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->promoModel->delete($id);
            session()->setFlashdata('pesan', 'success berhasil dihapus.');
            return redirect()->to(base_url('admin/promo'));
        }
    }
}
