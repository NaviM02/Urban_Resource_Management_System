<?php

namespace App\Domain\Enums;

enum CollectionStatusEnum: int {
    public const SCHEDULED = 1;

    public const IN_PROGRESS = 2;

    public const COMPLETED = 3;

    public const INCOMPLETED = 4;
}
