<?php

namespace App\Controllers\Admin;

use App\Models\InfoModel;
use App\Controllers\BaseController;

class Info extends BaseController
{
    protected $infoModel;
    public function __construct()
    {
        $this->infoModel = new InfoModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Information',
            'informations' => $this->infoModel->getInformations(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/info', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'info' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/info'));
            } else {
                $this->infoModel->save([
                    'info' => htmlspecialchars($this->request->getVar('info')),
                    'updated_by' => session('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/info'));
            }
        }
    }
    public function detail($id)
    {
        $data = [
            'information' => $this->infoModel->getInformations($id),
        ];
        return view('admin/modal/edit/info', $data);
    }

    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'info' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/info'));
            } else {
                $this->infoModel->save([
                    'id' => $id,
                    'info' => htmlspecialchars($this->request->getVar('info')),
                    'updated_by' => session()->get('full_name'),
                ]);
            }
            return redirect()->to(base_url('admin/info'))->withInput();
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->infoModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/info'));
        }
    }
}
