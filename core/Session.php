<?php

namespace app\core;

class Session
{
    protected const FLASH_KEY = 'flash_mess';

    public function __construct()
    {
        session_start();
        foreach ($_SESSION[self::FLASH_KEY] ?? [] as $key => &$message) {
            $message['remove'] = true;
        }
    }

    public function setFlash($key, $message): void
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message,
        ];
    }

    public function getFlash($key): string
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$message) {
            if($message['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}