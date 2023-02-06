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
        $stored_messages = $this->get('error_messages');
        if ($stored_messages == null) {
            $this->set('error_messages', array($message));
        } else {
            $stored_messages[] = $message;
            $this->set('error_messages', $stored_messages);
        }
    }

    public function getErrorMessages()
    {
        $error_message = $this->get('error_messages');
        $this->remove('error_messages');
        return $error_message;
    }

    public function getSession() : array
    {
        return $_SESSION;
    }

}