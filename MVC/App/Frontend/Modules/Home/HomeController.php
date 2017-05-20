<?php

namespace App\Frontend\Modules\Home;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;

class HomeController extends Controller
{
    public function executeIndex(HTTPRequest $request)
    {
		$this->page->addVar('title', 'Accueil');
    }
}
