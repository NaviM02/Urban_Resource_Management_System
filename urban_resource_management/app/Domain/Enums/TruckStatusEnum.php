<?php

namespace App\Domain\Enums;

enum TruckStatusEnum: int {
    public const OPERATIONAL = 1;

    public const MAINTENANCE = 2;

    public const OUT_OF_SERVICE = 3;

    public const DELETED = 4;
}
