<?php

namespace App\Frontend;

use \LibPtut\Application;
use \LibPtut\HTTPException;
use \App\Frontend\Modules\Errors\ErrorsController;

class FrontendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    public function run()
    {
        $controller = $this->getController();
        try
        {
            $httpResponse = $controller->execute($this->httpRequest);
        }
        catch (HTTPException $e)
        {
            $controller = new ErrorsController($this, 'Errors', $e->getStatusCode());
            $httpResponse = $controller->execute($this->httpRequest);
        }
        finally
        {
            $httpResponse->send();
        }
    }
}
