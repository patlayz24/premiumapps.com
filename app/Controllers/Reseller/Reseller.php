<?php

namespace App\Controllers\Reseller;

use App\Models\GameModel;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\ResellerBillModel;
use App\Controllers\BaseController;

class Reseller extends BaseController
{

    protected $gameModel;
    protected $productModel;
    protected $transactionModel;
    protected $resellerBillModel;
    public function __construct()
    {
        $this->gameModel = new GameModel();
        $this->productModel = new ProductModel();
        $this->transactionModel = new TransactionModel();
        $this->resellerBillModel = new ResellerBillModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Top Up Game',
            'request' => \Config\Services::request(),
            'games' => $this->gameModel->getGames(),
        ];
        return view('reseller/index', $data);
    }

    public function productdetail($slug)
    {
        $data = [
            'title' => 'Top Up Game',
            'game' => $this->gameModel->getGameSlug($slug),
            'request' => \Config\Services::request(),
            'products' => $this->productModel->getProductName(),
        ];
        return view('reseller/productdetail', $data);
    }

    public function bill()
    {

        $data = [
            'title' => 'Tagihan',
            'payments' => $this->resellerBillModel->getResellerBill(session('id_reseller')),
            'request' => \Config\Services::request(),
        ];
        return view('reseller/tagihan', $data);
    }

    public function transaction()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'user_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silakan isi user id Anda!',
                    ]
                ],
                'denom' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silakan pilih nominal yang tersedia!',
                    ]
                ],
                'quantity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silakan isi jumlah yang di inginkan!',
                    ]
                ],
                'contact' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silakan isi nomor whatsapp Anda!',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->back()->withInput();
            } else {

                $denom = htmlspecialchars($this->request->getVar('denom'));
                $product = $this->productModel->getProductId($denom);
                $quantity = intval(htmlspecialchars($this->request->getVar('quantity')));

                $data = [
                    'transaction_number' =>  date("dhmms"),
                    'id_reseller' => session('id_reseller'),
                    'id_product' => $product['id_product'],
                    'id_game' => htmlspecialchars($this->request->getVar('id_game')),
                    'user_id' => htmlspecialchars($this->request->getVar('user_id')),
                    'denomination' => $denom,
                    'quantity' => htmlspecialchars($this->request->getVar('quantity')),
                    'total' => intval($this->request->getVar('quantity')) * intval($product['reseller_price']),
                    'price' => $product['reseller_price'],
                    'payment_method' => 'Reseller',
                    'contact' => htmlspecialchars($this->request->getVar('contact')),
                    'status' => 'Diproses',
                ];

                $bill = $this->resellerBillModel->getIdReseller($data['id_reseller'], date("Y-m-d"));

                if ($bill == null) {
                    $insert = [
                        'transaction_number' => date("dhmms"),
                        'id_reseller' => $data['id_reseller'],
                        'price' => $data['total'],
                        'status' => '0',
                        'created_at' => date("Y-m-d"),
                    ];
                    $this->resellerBillModel->insertBill($insert);
                    $this->transactionModel->save($data);
                    $this->productModel->save([
                        'id_product' => htmlspecialchars($product['id_product']),
                        'stock' => intval($product['stock']) - intval($quantity),
                    ]);
                } else if (date("Y-m-d") == $bill['created_at']) {

                    $update = [
                        'transaction_number' => $bill['transaction_number'],
                        'id_reseller' => $data['id_reseller'],
                        'price' => $bill['price'] + $data['total'],
                        'created_at' => $bill['created_at'],
                        'updated_at' => $bill['updated_at'],
                        'status' => '0',
                    ];
                    $this->resellerBillModel->updateBill($update, $bill['created_at'], $data['id_reseller'], $bill['transaction_number']);
                    $this->transactionModel->save($data);
                    $this->productModel->save([
                        'id_product' => htmlspecialchars($product['id_product']),
                        'stock' => intval($product['stock']) - intval($quantity),
                    ]);
                }
            }
            return redirect()->to(base_url('reseller/pesanan'));
        } else {
            return redirect()->back()->withInput();
        }
    }
}
