<?php

namespace LibPtut;

class Page extends ApplicationComponent
{
    protected $contentFile;
    protected $vars = [];
    protected $scripts = [];

    public function addVar($var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var))
        {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
        }

        $this->vars[$var] = $value;
    }

    public function addVars(array $array)
    {
        foreach($array as $var => $value)
        {
            $this->addVar($var, $value);
        }
    }

    public function addScript($script)
    {
        if (!is_string($script) || is_numeric($script) || empty($script))
        {
            throw new \InvalidArgumentException('Le chemin du script doit être une chaine de caractères non nulle');
        }

        array_push($this->scripts, $script);
    }

    public function addScripts(array $array)
    {
        foreach($array as $script)
        {
            $this->addVar($script);
        }
    }

    public function getGeneratedPage()
    {
        if (!file_exists($this->contentFile))
        {
            throw new \RuntimeException('La vue '.$this->contentFile.' n\'existe pas');
        }

		$user = $this->app->getUser();

        extract($this->vars);

        ob_start();
            require($this->contentFile);
        $content = ob_get_clean();

        ob_start();
            foreach($this->scripts as $script)
            {
                echo '<script src="js/'.$script.'"></script>'.PHP_EOL;
            }
        $scripts = ob_get_clean();

        ob_start();
            require(__DIR__.'/../../Web/layout/layout.php');
        return ob_get_clean();
    }

    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile))
        {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }

        $this->contentFile = $contentFile;
    }
}
