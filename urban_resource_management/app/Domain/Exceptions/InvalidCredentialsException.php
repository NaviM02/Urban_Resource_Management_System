<?php

namespace App\Domain\Exceptions;

class InvalidCredentialsException extends DomainException
{
    protected int $statusCode = 401;

    public function __construct(string $message = 'Invalid credentials')
    {
        parent::__construct($message);
    }
}
