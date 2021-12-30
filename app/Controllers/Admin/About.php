<?php

namespace App\Controllers\Admin;

use App\Models\AboutModel;
use App\Controllers\BaseController;


class About extends BaseController
{
    protected $aboutModel;
    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }
    public function index()
    {
        $data = [
            'title' => 'About',
            'about' => $this->aboutModel->getAbouts(1),
            'request' => \Config\Services::request(),
        ];
        return view('admin/about', $data);
    }

    public function detail()
    {
        $data = ['about' => $this->aboutModel->getAbouts(1),];
        return view('admin/modal/edit/about', $data);
    }

    public function update()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'about' => 'required',
                'promotion' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/about'));
            } else {
                $this->aboutModel->save([
                    'id' => 1,
                    'about' => htmlspecialchars($this->request->getVar('about')),
                    'promotion' => htmlspecialchars($this->request->getVar('promotion')),
                    'updated_by' => session('full_name'),
                ]);
            }
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/about'))->withInput();
        }
    }
}
