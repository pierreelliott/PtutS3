<?php

namespace App\Frontend\Modules\Accueil;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;

class AccueilController extends Controller
{
    public function executeIndex(HTTPRequest $request)
    {
		$this->page->addVar('title', 'Accueil - Sushinos');
    }
}
