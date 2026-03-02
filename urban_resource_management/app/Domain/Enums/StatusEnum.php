<?php

namespace App\Domain\Enums;

enum StatusEnum: int {
    public const ACTIVE = 1;

    public const INACTIVE = 2;

    public const DELETED = 3;
}
