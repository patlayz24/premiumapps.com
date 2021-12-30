<?php

namespace App\Controllers\Admin;

use App\Models\AboutModel;
use App\Controllers\BaseController;


class SyaratKetentuan extends BaseController
{
    protected $aboutModel;
    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Syarat Dan Ketentuan',
            'request' => \Config\Services::request(),
            'about' => $this->aboutModel->getAbouts(1),
        ];
        return view('admin/syaratketentuan', $data);
    }

    public function detail()
    {
        $data = [];
        return view('admin/modal/edit/sk', $data);
    }

    public function update()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'snk' => [
                    'rules' => 'uploaded[snk]|max_size[snk,5120]|ext_in[snk,pdf]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar',
                        'ext_in' => 'File yang anda pilih bukan pdf',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/syaratketentuan'));
            } else {
                $filePdf = $this->request->getFile('snk');
                $namePdf = $filePdf->getRandomName();
                $filePdf->move('assets/pdf', $namePdf);

                $this->aboutModel->save([
                    'id' => 1,
                    'tnc' => $namePdf,
                    'updated_by' => session('full_name'),
                ]);
            }
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/syaratketentuan'))->withInput();
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->aboutModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/syaratketentuan'));
        }
    }
}
