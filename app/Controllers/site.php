<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ContactModel;
use App\Models\VideoModel;
use App\Models\DevisModel;
use App\Models\ProposModel;

class Site extends BaseController
{
    public function index()
    {
        $serviceModel = new ServiceModel();
        $contactModel = new ContactModel();
        $videoModel = new VideoModel();
        $proposModel = new ProposModel();

        $data = [
            'title'    => 'Tafitasoa SARL | Transport à Madagascar',
            'propos'   => $proposModel->first(),
            'services' => $serviceModel->findAll(),
            'contacts' => $contactModel->findAll(),
            'video'    => $videoModel->first(),
        ];

        return view('site/accueille', $data);
    }
}
