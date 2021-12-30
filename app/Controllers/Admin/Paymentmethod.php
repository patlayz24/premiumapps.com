<?php

namespace App\Controllers\Admin;

use App\Models\PaymentMethodModel;
use App\Controllers\BaseController;

class PaymentMethod extends BaseController
{
    protected $paymentMethodModel;
    public function __construct()
    {
        $this->paymentMethodModel = new PaymentMethodModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Payment Method',
            'paymentMethods' => $this->paymentMethodModel->getPaymentMethods(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/paymentmethod', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'payment_category' => 'required',
                'bank_name' => 'required',
                'account_name' => 'required',
                'account_number' => 'required',
                'admin_fee' => 'required',
                'thumbnail' => [
                    'rules' => 'uploaded[thumbnail]|max_size[thumbnail,3072]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silakan pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ],
                'logo' => [
                    'rules' => 'uploaded[logo]|max_size[logo,3072]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silakan pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/paymentmethod');
            } else {
                $fileThumbnail = $this->request->getFile('thumbnail');
                $fileLogo = $this->request->getFile('logo');
                $nameThumbnail = $fileThumbnail->getRandomName();
                $nameLogo = $fileLogo->getRandomName();
                $fileThumbnail->move('assets/images/payment', $nameThumbnail);
                $fileLogo->move('assets/images/logo', $nameLogo);

                $this->paymentMethodModel->save([
                    'category' => htmlspecialchars($this->request->getVar('payment_category')),
                    'bank_name' => htmlspecialchars($this->request->getVar('bank_name')),
                    'account_name' => htmlspecialchars($this->request->getVar('account_name')),
                    'account_number' => htmlspecialchars($this->request->getVar('account_number')),
                    'admin_fee' => htmlspecialchars($this->request->getVar('admin_fee')),
                    'thumbnail' => $nameThumbnail,
                    'logo' => $nameLogo,
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/paymentmethod'));
            }
        }
    }

    public function detail($id)
    {
        $data = [
            'payment' => $this->paymentMethodModel->getPaymentMethods($id),
        ];

        return view('admin/modal/edit/paymentmethod', $data);
    }
    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'payment_category' => 'required',
                'bank_name' => 'required',
                'account_name' => 'required',
                'account_number' => 'required',
                'admin_fee' => 'required',
                'thumbnail' => [
                    'rules' => 'uploaded[thumbnail]|max_size[thumbnail,3072]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silakan pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ],
                'logo' => [
                    'rules' => 'max_size[logo,3072]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/paymentmethod');
            } else {
                $fileThumbnail = $this->request->getFile('thumbnail');
                $fileLogo = $this->request->getFile('logo');

                if (($fileThumbnail->getError() && $fileLogo->getError()) == 4) {
                    $nameThumbnail = $this->request->getVar('old_thumbnail');
                    $nameLogo = $this->request->getVar('old_logo');
                } else {
                    $nameThumbnail = $fileThumbnail->getRandomName();
                    $nameLogo = $fileThumbnail->getRandomName();
                    $fileThumbnail->move('assets/images/logo', $nameThumbnail);
                    $fileLogo->move('assets/images/payment', $nameLogo);
                }
                $this->paymentMethodModel->save([
                    'id' => $id,
                    'bank_name' => htmlspecialchars($this->request->getVar('bank_name')),
                    'account_name' => htmlspecialchars($this->request->getVar('account_name')),
                    'account_number' => htmlspecialchars($this->request->getVar('account_number')),
                    'admin_fee' => htmlspecialchars($this->request->getVar('admin_fee')),
                    'thumbnail' => $nameThumbnail,
                    'logo' => $nameLogo,
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to('/admin/paymentmethod')->withInput();
            }
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->paymentMethodModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('/admin/paymentmethod'));
        }
    }
}
