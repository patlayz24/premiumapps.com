<?php

namespace App\Controllers\Admin;

use App\Models\GameModel;
use App\Models\BrochureModel;
use App\Controllers\BaseController;

class Brochure extends BaseController
{
    protected $brochureModel;
    protected $gameModel;
    public function __construct()
    {
        $this->brochureModel = new BrochureModel();
        $this->gameModel = new GameModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Brochure',
            'brochures' => $this->brochureModel->getBrochures(),
            'games' => $this->gameModel->getGames(),
            'request' => \Config\Services::request(),
        ];

        return view('admin/brochure', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'brochure_name' => 'required',
                'desc_brochure' => 'required',
                'thumbnail' => [
                    'rules' => 'uploaded[thumbnail]|max_size[thumbnail,3072]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
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
                return redirect()->to(base_url('/admin/brochure/'));
            } else {
                $fileThumbnail = $this->request->getFile('thumbnail');
                $nameThumbnail = $fileThumbnail->getRandomName();
                $fileThumbnail->move('assets/images/brochures', $nameThumbnail);

                $this->brochureModel->save([
                    'brochure_name' => htmlspecialchars($this->request->getVar('brochure_name')),
                    'desc' => htmlspecialchars($this->request->getVar('desc_brochure')),
                    'thumbnail' => $nameThumbnail,
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/brochure'));
            }
        }
    }

    public function detail($id)
    {
        $data = [
            'brochure' => $this->brochureModel->getBrochures($id),
        ];
        return view('admin/modal/edit/brochure', $data);
    }

    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'brochure_name' => 'required',
                'desc_brochure' => 'required',
                'thumbnail' => [
                    'rules' => 'max_size[thumbnail,3072]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        // 'uploaded' => 'Silakan pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('/admin/brochure/'));
            } else {

                $fileThumbnail = $this->request->getFile('thumbnail');

                if ($fileThumbnail->getError() == 4) {
                    $nameThumbnail = $this->request->getVar('old_thumbnail');
                } else {
                    $nameThumbnail = $fileThumbnail->getRandomName();
                    $fileThumbnail->move('assets/images/brochures', $nameThumbnail);
                }
                $this->brochureModel->save([
                    'id' => $id,
                    'brochure_name' => htmlspecialchars($this->request->getVar('brochure_name')),
                    'desc' => htmlspecialchars($this->request->getVar('desc_brochure')),
                    'thumbnail' => $nameThumbnail,
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('admin/brochure'))->withInput();
            }
        }
    }


    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->brochureModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('/admin/brochure'));
        }
    }
}
