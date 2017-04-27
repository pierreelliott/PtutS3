<?php

namespace LibPtut;

class PDOFactory
{
	public static function getMySqlConnection($host, $dbname, $user, $pwd)
	{
		$db = new \PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pwd);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
