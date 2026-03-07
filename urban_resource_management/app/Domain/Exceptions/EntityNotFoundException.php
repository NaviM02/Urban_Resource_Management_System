<?php

namespace App\Domain\Exceptions;

class EntityNotFoundException extends DomainException
{
    protected int $statusCode = 404;

    public function __construct(string $message = 'Entity not found')
    {
        parent::__construct($message);
    }
}
