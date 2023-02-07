<?php
declare(strict_types=1);

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

    public function __call($name, $arguments)
    {
        return $this->get($name);
    }

    public function addErrorMessage(string $message) : void
    {
        $storedMessages = $this->get('errorMessages');
        if ($storedMessages == null) {
            $this->set('errorMessages', array($message));
        } else {
            $storedMessages[] = $message;
            $this->set('errorMessages', $storedMessages);
        }
    }

    public function getErrorMessages()
    {
        $error_message = $this->get('errorMessages');
        $this->remove('errorMessages');
        return $error_message;
    }

    public function getSession() : array
    {
        return $_SESSION;
    }

}