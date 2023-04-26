<?php

class Session
{

    public function __construct()
    {
        session_start();
    }


    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }


    public function flash($key)
    {
        $value = $this->get($key);
        $this->remove($key);
        return $value;
    }


    public function isset($key)
    {
        return isset($_SESSION[$key]);
    }


    public function all()
    {
        return $_SESSION;
    }


    public function old($key)
    {
        return $this->get('old_' . $key);
    }


    public function setOld($key, $value)
    {
        $this->set('old_' . $key, $value);
    }


    public function remove($key)
    {
        unset($_SESSION[$key]);
    }


    public function destroy()
    {
        session_destroy();
    }
}


$session = new Session();


$session->set('name', 'John');


$name = $session->get('name');


$success = $session->flash('success');


if ($session->isset('name')) {
}


$data = $session->all();

$oldEmail = $session->old('email');
