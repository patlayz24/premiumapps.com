<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\ResellerBillModel;
use App\Models\ProductModel;


class Proses extends BaseController
{

    protected $transactionModel;
    protected $resellerBillModel;
    protected $productModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->resellerBillModel = new ResellerBillModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Proses',
            'transactions' => $this->transactionModel->getProsesData(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/proses', $data);
    }

    public function content()
    {
        $data = [
            'title' => 'Proses',
            'transactions' => $this->transactionModel->getProsesData(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/autoload/proses', $data);
    }

    public function detail($id)
    {
        $data = [
            'transaction' => $this->transactionModel->getData($id),
        ];
        return view('admin/modal/detail/detailtransaksi', $data);
    }

    public function selesai($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {

            $this->transactionModel->save([
                'id_transaction' => $id,
                'status' => htmlspecialchars('Selesai'),
                'process_by' => session()->get('full_name'),
            ]);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/proses'));
        }
    }

    public function reject($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {

            $transaction = $this->transactionModel->getTransactions($id);
            $bill = $this->resellerBillModel->getIdReseller($transaction['id_reseller'], date("Y-m-d"));
            $denominationProduct = intval($transaction['denomination']);
            $product = $this->productModel->getProductId($denominationProduct);
            $this->productModel->save([
                'id_product' => $product['id_product'],
                'stock' => intval($product['stock']) + intval($transaction['quantity']),
            ]);
            $this->transactionModel->save([
                'id_transaction' => $id,
                'status' => 'Ditolak',
                'confirm_by' => session('full_name'),
            ]);

            $update = [
                'transaction_number' => $bill['transaction_number'],
                'id_reseller' => $transaction['id_reseller'],
                'price' => $bill['price'] - $transaction['total'],
                'created_at' => $bill['created_at'],
                'updated_at' => $bill['updated_at'],
                'status' => '0',
            ];
            $this->resellerBillModel->updateBill($update, $bill['created_at'], $transaction['id_reseller'], $bill['transaction_number']);

            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/proses'));
        }
    }
}
