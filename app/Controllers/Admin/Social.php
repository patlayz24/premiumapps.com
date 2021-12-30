<?php

namespace App\Controllers\Admin;

use App\Models\SocialModel;
use App\Controllers\BaseController;


class Social extends BaseController
{
    protected $socialModel;
    public function __construct()
    {
        $this->socialModel = new SocialModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Social',
            'request' => \Config\Services::request(),
            'socials' => $this->socialModel->getSocials(),
        ];
        return view('admin/social', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'social' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/social'));
            } else {
                $this->socialModel->save([
                    'social_media' => htmlspecialchars($this->request->getVar('social')),
                    'url' => htmlspecialchars($this->request->getVar('url')),
                    'a_class' => htmlspecialchars($this->request->getVar('a_class')),
                    'icon_class' => htmlspecialchars($this->request->getVar('icon_class')),
                    'username' => htmlspecialchars($this->request->getVar('username')),
                    'updated_by' => session('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/social'));
            }
        }
    }
    public function detail($id)
    {
        $data = [
            'social' => $this->socialModel->getSocials($id),
        ];
        return view('admin/modal/edit/social', $data);
    }

    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'social' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/social'));
            } else {
                $this->socialModel->save([
                    'id' => $id,
                    'social_media' => htmlspecialchars($this->request->getVar('social')),
                    'url' => htmlspecialchars($this->request->getVar('url')),
                    'a_class' => htmlspecialchars($this->request->getVar('a_class')),
                    'icon_class' => htmlspecialchars($this->request->getVar('icon_class')),
                    'username' => htmlspecialchars($this->request->getVar('username')),
                    'updated_by' => session('full_name'),
                ]);
            }
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to(base_url('admin/social'))->withInput();
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->socialModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/social'));
        }
    }
}
