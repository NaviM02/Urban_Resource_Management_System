<?php

namespace App\Domain\Exceptions;

use Exception;

class DomainException extends Exception
{
    protected int $statusCode = 400;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
