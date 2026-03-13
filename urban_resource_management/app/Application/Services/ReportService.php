<?php

namespace App\Application\Services;

use App\Domain\Repositories\ReportRepository;

class ReportService
{

    private ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getTonsByDay($start,$end)
    {
        return $this->reportRepository->tonsByDay($start,$end);
    }

    public function getTonsByWeek($year)
    {
        return $this->reportRepository->tonsByWeek($year);
    }

    public function getTonsByMonth($year)
    {
        return $this->reportRepository->tonsByMonth($year);
    }

    public function getTonsByZone($start,$end)
    {
        return $this->reportRepository->tonsByZone($start,$end);
    }

    public function getTonsByRoute($start,$end)
    {
        return $this->reportRepository->tonsByRoute($start,$end);
    }

    public function getRecycledByMaterial()
    {
        return $this->reportRepository->getRecycledByMaterial();
    }

    public function getMostActiveGreenPoints()
    {
        return $this->reportRepository->getMostActiveGreenPoints();
    }

    public function getRecyclingTrend()
    {
        return $this->reportRepository->getRecyclingTrend();
    }

    public function getComplaintsStatusSummary()
    {
        return $this->reportRepository
            ->getComplaintsStatusSummary();
    }

    public function getAverageAttentionTime()
    {
        return $this->reportRepository
            ->getAverageAttentionTime();
    }

    public function getCriticalZones()
    {
        return $this->reportRepository
            ->getCriticalZones();
    }

}
