<?php

namespace LibPtut;

class Config extends ApplicationComponent
{
	protected $vars = [];

	public function get($var)
	{
		if (!$this->vars)
		{
			$xml = new \DOMDocument;
			$filename = __DIR__.'/../../App/'.$this->app->getName().'/Config/config.xml';
			$xml->load($filename);

			$elements = $xml->getElementsByTagName('define');

			foreach ($elements as $element)
			{
				$this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
			}
		}

		if (isset($this->vars[$var]))
		{
			return $this->vars[$var];
		}

		return null;
	}

	public function set($var, $value)
	{
		$xml = new \DOMDocument;
		$filename = __DIR__.'/../../App/'.$this->app->getName().'/Config/config.xml';
		$xml->load($filename);

		$elements = $xml->getElementsByTagName('define');

		foreach ($elements as $element)
		{
			if($element->attributes->getNamedItem('var')->nodeValue == $var)
			{
				$element->attributes->getNamedItem('value')->nodeValue = $value;
			}
		}

		$xml->save($filename);
	}
}
