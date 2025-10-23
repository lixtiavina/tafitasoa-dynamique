<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\VideoModel;
use App\Models\DevisModel;
use App\Models\ProposModel;

class Site extends BaseController
{
    public function index()
    {
        $serviceModel = new ServiceModel();
        $videoModel = new VideoModel();
        $proposModel = new ProposModel();

        $data = [
            'title'    => 'Transport à Madagascar | Tafitasoa SARL',
            'propos'   => $proposModel->first(),
            'services' => $serviceModel->findAll(),
            'video'    => $videoModel->first(),
        ];

        return view('site/accueille', $data);
    }
}
