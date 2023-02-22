<?php
declare(strict_types=1);

namespace App\Core;

class Session
{

    private const ADMIN_ROLE = 'Admin';

    public function get(string $key) : mixed
    {
        return $_SESSION[$key] ?? null;
    }


    public function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function __call(string $name, array $arguments) : mixed
    {
        return $this->get($name);
    }

    public function addMessage(string $message, MessageType $type) : void
    {
        $newMessage = ['content' => $message, 'type' => $type->value];
        $storedMessages = $this->get('errorMessages');
        if ($storedMessages === null) {
            $this->set('errorMessages', array($newMessage));
        } else {
            $storedMessages[] = $newMessage;
            $this->set('errorMessages', $storedMessages);
        }
    }

    public function getMessages() : mixed
    {
        $error_message = $this->get('errorMessages');
        $this->remove('errorMessages');
        return $error_message;
    }

    public function destroySession() : void
    {
        $_SESSION = array();
        session_destroy();
    }

    public function getSession() : array
    {
        return $_SESSION;
    }

    public function isLoggedIn() : string
    {
        return $this->get('userId');
    }

    public function isUserAdmin() : bool
    {
        return $this->get('userRole') == $this::ADMIN_ROLE;
    }
}
