<?php

namespace App\Controllers\Admin;

use App\Models\PromoModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Controllers\BaseController;


class Payment extends BaseController
{

    protected $transactionModel;
    protected $productModel;
    protected $promoModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->productModel = new ProductModel();
        $this->promoModel = new PromoModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Payment',
            'transactions' => $this->transactionModel->getPaymentData(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/payment', $data);
    }

    public function content()
    {
        $data = [
            'title' => 'Payment',
            'transactions' => $this->transactionModel->getPaymentData(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/autoload/payment', $data);
    }

    public function detail($id)
    {
        $data = [
            'transaction' => $this->transactionModel->getData($id),
        ];
        return view('admin/modal/detail/detailtransaksi', $data);
    }


    // diproses
    public function process($id)
    {
        // Stock kan udah berkurang Dikurangi QTY itu biarkan jika method ini di jalankan. CHECK komen di bagian Reject
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $this->transactionModel->save([
                'id_transaction' => $id,
                'status' => htmlspecialchars('Diproses'),
                'confirm_by' => session()->get('full_name'),
            ]);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/payment'));
        }
    }

    // diproses
    public function reject($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            // jika pesanan di reject stocknya balikin (Stock + QTY)
            $transaction = $this->transactionModel->getTransactions($id);
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
            $promo = $this->promoModel->getPromoCode($transaction['voucher']);
            if ($transaction['voucher'] != "") {
                $this->promoModel->save([
                    'id' => $promo['id'],
                    'stock' => intval($promo['stock']) + 1,
                ]);
            }
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/payment'));
        }
    }
}
