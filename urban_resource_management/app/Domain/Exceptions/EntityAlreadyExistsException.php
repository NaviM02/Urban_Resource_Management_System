<?php

namespace App\Domain\Exceptions;

class EntityAlreadyExistsException extends DomainException
{
    protected int $statusCode = 409;

    public function __construct(string $message = 'Entity already exists')
    {
        parent::__construct($message);
    }
}
