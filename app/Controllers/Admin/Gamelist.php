<?php

namespace App\Controllers\Admin;

use App\Models\GameModel;
use App\Controllers\BaseController;

class Gamelist extends BaseController
{
    protected $gameModel;
    public function __construct()
    {
        $this->gameModel = new GameModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Game List',
            'games' => $this->gameModel->getGames(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/gamelist', $data);
    }

    public function save()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'game_name' => 'required',
                'desc_game' => 'required',
                'thumbnail' => [
                    'rules' => 'uploaded[thumbnail]|max_size[thumbnail,3072]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silakan pilih gambar terlebih dahulu',
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar',
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/gamelist'));
            } else {

                $fileThumbnail = $this->request->getFile('thumbnail');
                $nameThumbnail = $fileThumbnail->getRandomName();
                $fileThumbnail->move('assets/images/gamelist', $nameThumbnail);
                $slug = url_title($this->request->getVar('game_name'), '-', true);
                $this->gameModel->save([
                    'game_name' => htmlspecialchars($this->request->getVar('game_name')),
                    'desc' => htmlspecialchars($this->request->getVar('desc_game')),
                    'slug' => htmlspecialchars($slug),
                    'thumbnail' => $nameThumbnail,
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambah');
                return redirect()->to(base_url('admin/gamelist'));
            }
        }
    }

    public function detail($getData)
    {
        $data = [
            'gamelist' => $this->gameModel->getGameSlug($getData),
        ];
        return view('admin/modal/edit/gamelist', $data);
    }

    public function update($id)
    {
        helper(['form']);
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'game_name' => 'required',
                'desc_game' => 'required',
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
                return redirect()->to('admin/gamelist');
            } else {
                $fileThumbnail = $this->request->getFile('thumbnail');

                if ($fileThumbnail->getError() == 4) {
                    $nameThumbnail = $this->request->getVar('old_thumbnail');
                } else {
                    $nameThumbnail = $fileThumbnail->getRandomName();
                    $fileThumbnail->move('assets/images/gamelist', $nameThumbnail);
                }
                $slug = url_title($this->request->getVar('game_name'), '-', true);
                $this->gameModel->save([
                    'id_game' => $id,
                    'game_name' => htmlspecialchars($this->request->getVar('game_name')),
                    'slug' => htmlspecialchars($slug),
                    'desc' => htmlspecialchars($this->request->getVar('desc_game')),
                    'thumbnail' => $nameThumbnail,
                    'updated_by' => session()->get('full_name'),
                ]);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to('admin/gamelist')->withInput();
            }
        }
    }

    public function delete($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->gameModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('/admin/gamelist'));
        }
    }
}
