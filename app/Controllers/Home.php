<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\PromoModel;
use App\Models\ReportModel;
use App\Models\ProductModel;
use App\Models\BrochureModel;
use App\Models\TransactionModel;
use App\Models\PaymentMethodModel;
use App\Models\AboutModel;
use App\Models\SocialModel;
use PhpParser\Node\Stmt\Echo_;

class Home extends BaseController
{
	protected $gameModel;
	protected $brochureModel;
	protected $productModel;
	protected $transactionModel;
	protected $paymentMethodModel;
	protected $recomendation;
	protected $aboutModel;
	protected $socialModel;

	public function __construct()
	{
		$this->gameModel = new GameModel();
		$this->brochureModel = new BrochureModel();
		$this->productModel = new ProductModel();
		$this->promoModel = new PromoModel();
		$this->transactionModel = new TransactionModel();
		$this->paymentMethodModel = new PaymentMethodModel();
		$this->recomendation = new ReportModel();
		$this->aboutModel = new AboutModel();
		$this->socialModel = new SocialModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Kota Digital - Top Up Game Murah',
			'games' => $this->gameModel->getGames(),
			'brochures' => $this->brochureModel->getBrochures(),
			'recomendations' => $this->recomendation->popularProduct(),
			'about' => $this->aboutModel->getAbouts(1),
			'socials' => $this->socialModel->getSocials(),
		];
		return view('home/index', $data);
	}

	public function productdetail($slug)
	{
		$paymentCategories = [
			'Bank Transfer',
			'E-Wallet',
			'Gerai',
		];
		$data = [
			'title' => 'Top Up - Kota Digital',
			'game' => $this->gameModel->getGameSlug($slug),
			'products' => $this->productModel->getProductName($slug),
			'paymentmethods' => $this->paymentMethodModel->getPaymentMethods(),
			'paymentCategories' => $paymentCategories,
			'about' => $this->aboutModel->getAbouts(1),
			'socials' => $this->socialModel->getSocials(),
		];
		if (empty($data['game'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Data ' . $slug . ' tidak di temukan');
		}
		return view('home/productdetail', $data);
	}

	public function setSession()
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
				'method' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Silakan pilih metode pembayaran yang ada!',
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
				$transaction_number = date("dhmms");
				$random = intval(rand(10, 500));
				$quantity = intval(htmlspecialchars($this->request->getVar('quantity')));
				$price = intval($product['price']);

				if ($this->request->getVar('voucher') == null) {
					$discount = 0;
				} else {
					if ($this->promoModel->getPromoCode($this->request->getVar('voucher')) == null) {
						session()->setFlashdata('error', 'Kode Voucher Tidak Tersedia!');
						return redirect()->back()->withInput();
					} else {
						$voucher = $this->promoModel->getPromoCode($this->request->getVar('voucher'));
						$discount =  intval($price * $quantity * ($voucher['discount'] / 100));
					}
				}

				$data = [
					'transaction_number' => $transaction_number,
					'id_reseller' => 0,
					'id_game' => htmlspecialchars($this->request->getVar('id_game')),
					'user_id' => htmlspecialchars($this->request->getVar('user_id')),
					'denomination' => $denom,
					'quantity' => $quantity,
					'price' => $price,
					'random' => $random,
					'total' => (($price * $quantity) + $random) - $discount,
					'payment_method' => htmlspecialchars($this->request->getVar('method')),
					'contact' => htmlspecialchars($this->request->getVar('contact')),
					'voucher' => htmlspecialchars($this->request->getVar('voucher')),
					'status' => 'Menunggu Konfirmasi',
				];
				if ($this->request->getVar('voucher') == null) {
					session()->set([
						'transaction_number' => $transaction_number,
						'id_game' => htmlspecialchars($this->request->getVar('id_game'))
					]);
					$product = $this->productModel->getProductId($denom);
					$this->transactionModel->save($data);
					// Stock - QTY
					$this->productModel->save([
						'id_product' => htmlspecialchars($product['id_product']),
						'stock' => intval($product['stock']) - intval($quantity),
					]);
					return redirect()->to(base_url('checkout'));
				}

				if ($this->promoModel->getPromoCode($data['voucher']) != null) {
					// Masukin TRX ke DB dgn status Menunggu Konfirmasi !
					session()->set([
						'transaction_number' => $transaction_number,
						'id_game' => htmlspecialchars($this->request->getVar('id_game'))
					]);

					$promo = $this->promoModel->getPromoCode($data['voucher']);
					if ($promo['stock'] <= 0) {
						session()->setFlashdata('error', 'Voucher telah habis!');
						return redirect()->back()->withInput();
					} else {
						// Stock voucher  - 1
						$this->promoModel->save([
							'id' => $promo['id'],
							'stock' => intval($promo['stock']) - 1,
						]);
						$this->transactionModel->save($data);
						// Stock - QTY
						$product = $this->productModel->getProductId($denom);
						$this->productModel->save([
							'id_product' => htmlspecialchars($product['id_product']),
							'stock' => intval($product['stock']) - intval($quantity),
						]);
						return redirect()->to(base_url('checkout'));
					}
				} else {
					session()->setFlashdata('error', 'Kode Voucher Tidak Tersedia!');
					return redirect()->back()->withInput();
				}
			}
		} else {
			return redirect()->back()->withInput();
		}
	}

	public function checkout()
	{
		if (session('transaction_number') == null) {
			return redirect()->to(base_url());
		} else {
			$transaction = $this->transactionModel->getTransactionsByNumber(session('transaction_number'));
			if ($transaction['voucher'] != '') {
				$voucher = $this->promoModel->getPromoCode($transaction['voucher']);
			} else {
				$voucher['discount'] = 0;
			}
			$data = [
				'title' => 'Checkout - Kota Digital',
				'game' => $this->gameModel->getGames(htmlspecialchars(session('id_game'))),
				'paymentMethod' => $this->paymentMethodModel->getPaymentMethods(),
				'transaction' => $this->transactionModel->getData(session('transaction_number')),
				'discount' => intval($voucher['discount']),
			];
			return view('home/checkout', $data);
		}
	}

	public function transaction()
	{
		if ($this->request->getMethod() == 'post') {
			$idTransaction = $this->transactionModel->getData(session('transaction_number'));
			// Ubah Status Jadi TERKONFIRMASI !
			$this->transactionModel->save([
				'id_transaction' => $idTransaction['id_transaction'],
				'status' => 'Terkonfirmasi',
			]);
			session()->destroy();
			return redirect()->to(base_url('cekpesanan'));
		} else {
			return redirect()->back()->withInput();
		}
	}
	public function cekpesanan()
	{
		$data = [
			'title' => 'Cek Pesanan - Kota Digital',
			'about' => $this->aboutModel->getAbouts(1),
			'socials' => $this->socialModel->getSocials(),
		];
		return view('home/pesanan', $data);
	}

	public function detailpesanan($id)
	{
		$data = [
			'transaction' => $this->transactionModel->getData($id),
			'about' => $this->aboutModel->getAbouts(1),
			'socials' => $this->socialModel->getSocials(),
		];
		return view('home/ajax/pesanan', $data);
	}
	public function reject()
	{
		helper(['form']);
		if ($this->request->getMethod() == 'put') {
			// jika pesanan di reject stocknya balikin (Stock + QTY)
			$transaction = $this->transactionModel->getTransactionsByNumber(session('transaction_number'));
			$denominationProduct = intval($transaction['denomination']);
			$product = $this->productModel->getProductId($denominationProduct);
			$this->productModel->save([
				'id_product' => $product['id_product'],
				'stock' => intval($product['stock']) + intval($transaction['quantity']),
			]);
			$this->transactionModel->save([
				'id_transaction' => $transaction['id_transaction'],
				'status' => 'Ditolak',
				'confirm_by' => session()->get('full_name'),
			]);
			$promo = $this->promoModel->getPromoCode($transaction['voucher']);
			if ($transaction['voucher'] != "") {
				$this->promoModel->save([
					'id' => $promo['id'],
					'stock' => intval($promo['stock']) + 1,
				]);
			}
			session()->destroy();
			return redirect()->back();
		}
	}
}
