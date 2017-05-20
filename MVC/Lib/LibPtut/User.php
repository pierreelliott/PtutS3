<?php

namespace LibPtut;

if(session_status() == PHP_SESSION_NONE)
	session_start();

class User
{
	public function hasAttribute($key)
	{
		return isset($_SESSION[$key]);
	}

	public function setAttribute($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function getAttribute($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

	public function setFlash($value)
    {
        $_SESSION['flash'] = $value;
    }

    public function getFlash()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);

        return $flash;
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAuthenticated($authenticated = true)
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
        }

        $_SESSION['auth'] = $authenticated;
    }
}
