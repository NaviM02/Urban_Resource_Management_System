<?php

namespace App\Domain\Enums;

enum RoleEnum: int {
    public const ADMIN = 1;

    public const ROUTE_COORDINATOR = 2;

    public const OPERATOR = 3;

    public const CIVIL = 4;

    public const AUDITOR = 5;
}
