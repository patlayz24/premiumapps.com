<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Do something here
    if (!session()->get('id_role') == '') {
      session()->setFlashdata('pesan', 'Anda belum login, silakan login terlebih dahulu!');
      return redirect()->to('/login');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    if (session()->get('id_role') == 2) {
      return redirect()->to('/admin');
    }
  }
}
