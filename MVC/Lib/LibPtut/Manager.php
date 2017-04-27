<?php

namespace LibPtut;

abstract class Manager
{
	protected $dao;

	public function __construct($dao)
	{
		$this->dao = $dao;
	}
}
