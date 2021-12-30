<?php

namespace App\Controllers\Admin;

use App\Models\GameModel;
use App\Models\ProductModel;
use App\Controllers\BaseController;

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
            'games' => $this->gameModel->getGames(),
            'products' => $this->productModel->getProductName(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/product', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'select_game' => 'required',
                'denomination' => 'required',
                'price' => 'required',
                'reseller_price' => 'required',
                'stock' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/product');
            } else {
                $this->productModel->save([
                    'id_game' => htmlspecialchars($this->request->getVar('select_game')),
                    'denomination' => htmlspecialchars($this->request->getVar('denomination')),
                    'price' => htmlspecialchars($this->request->getVar('price')),
                    'reseller_price' => htmlspecialchars($this->request->getVar('reseller_price')),
                    'stock' => htmlspecialchars($this->request->getVar('stock')),
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/product'));
            }
        }
    }

    public function detail($id)
    {
        $data = [
            'product' => $this->productModel->getProducts($id),
            'games' => $this->gameModel->getGames(),
        ];
        return view('admin/modal/edit/product', $data);
    }

    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'select_game' => 'required',
                'denomination' => 'required',
                'price' => 'required',
                'reseller_price' => 'required',
                'stock' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/product');
            } else {
                $this->productModel->save([
                    'id_product' => $id,
                    'id_game' => htmlspecialchars($this->request->getVar('select_game')),
                    'denomination' => htmlspecialchars($this->request->getVar('denomination')),
                    'price' => htmlspecialchars($this->request->getVar('price')),
                    'reseller_price' => htmlspecialchars($this->request->getVar('reseller_price')),
                    'stock' => htmlspecialchars($this->request->getVar('stock')),
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('admin/product'));
            }
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->productModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('/admin/product'));
        }
    }
}
