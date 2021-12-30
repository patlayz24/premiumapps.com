<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kota Digital - Top Up Game Murah',
            // 'games' => $this->gameModel->getGames(),
            // 'brochures' => $this->brochureModel->getBrochures(),
            // 'recomendations' => $this->recomendation->popularProduct(),
            // 'about' => $this->aboutModel->getAbouts(1),
            // 'socials' => $this->socialModel->getSocials(),
        ];
        return view('home/index', $data);
    }
}
