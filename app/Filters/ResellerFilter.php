<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ResellerFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Do something here
    if (!session()->get('id_reseller') == '') {
      session()->setFlashdata('pesan', 'Anda belum login, silakan login terlebih dahulu!');
      return redirect()->to('/login');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    if (session()->get('id_reseller')) {
      return redirect()->to('/reseller');
    }
  }
}
