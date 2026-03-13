<?php

namespace App\Domain\Enums;

enum ComplaintStatusEnum: int {
    public const RECEIVE = 1;

    public const REVIEW = 2;

    public const ASSIGNED = 3;


    public const IN_PROGRESS = 4;

    public const ATTENDED = 5;

    public const CLOSED = 6;
}
