<?php

namespace App\Frontend\Modules\Errors;

use \LibPtut\Controller;
use \LibPtut\HTTPRequest;
use \LibPtut\HTTPResponse;

class ErrorsController extends Controller
{
    public function execute404(HTTPRequest $request)
    {
        return $this->renderView('404', array(
            'title' => '404 Page non trouvée'
        ));
    }
}
