<?php

namespace App\Domain\Enums;

enum ComplaintStatusEnum: int {
    public const RECEIVE = 1;

    public const REVISION = 2;

    public const ASSIGN = 3;


    public const IN_ATTENTION = 4;

    public const ATTENDED = 5;

    public const CLOSE = 6;
}
