<?php

namespace App\Core;

class Session
{
    public function get($key) : mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key): void
    {
        unset($_SESSION[$key]);
    }

    public function addErrorMessage($message) : void
    {
        $this->set('errorMessage', $message);
    }

    public function getErrorMessage()
    {
        $errorMessage = $this->get('errorMessage');
        $this->remove('errorMessage');
        return $errorMessage;
    }

}