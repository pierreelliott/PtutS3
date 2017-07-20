<?php

namespace App\Frontend\Modules\Home;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;
use \LibPtut\HTTPResponse;
use \LibPtut\HTTPException;

class HomeController extends Controller
{
    public function executeIndex(HTTPRequest $request)
    {
        return $this->renderView('index', array(
            'title' => 'Accueil'
        ));
    }
}
