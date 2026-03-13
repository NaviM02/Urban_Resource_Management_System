<?php

namespace App\View\Support;

class Toast
{
    protected static function add(string $type, string $message)
    {
        $toasts = session()->get('toasts', []);

        $toasts[] = [
            'type' => $type,
            'message' => $message
        ];

        session()->put('toasts', $toasts);
    }

    public static function success(string $message)
    {
        self::add('success', $message);
    }

    public static function error(string $message)
    {
        self::add('error', $message);
    }

    public static function info(string $message)
    {
        self::add('info', $message);
    }

    public static function warning(string $message)
    {
        self::add('warning', $message);
    }
}
