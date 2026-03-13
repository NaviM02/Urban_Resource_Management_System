<?php

namespace App\Domain\Repositories;

interface ReportRepository
{
    // Collection Reports
    public function tonsByDay($startDate, $endDate);

    public function tonsByWeek($year);

    public function tonsByMonth($year);

    public function tonsByZone($startDate, $endDate);

    public function tonsByRoute($startDate, $endDate);


}
