<?php

namespace App\View\Support;

class Toast
{
    public static function success(string $message)
    {
        session()->flash('toast', [
            'type' => 'success',
            'message' => $message
        ]);
    }

    public static function error(string $message)
    {
        session()->flash('toast', [
            'type' => 'error',
            'message' => $message
        ]);
    }

    public static function info(string $message)
    {
        session()->flash('toast', [
            'type' => 'info',
            'message' => $message
        ]);
    }

    public static function warning(string $message)
    {
        session()->flash('toast', [
            'type' => 'warning',
            'message' => $message
        ]);
    }
}
