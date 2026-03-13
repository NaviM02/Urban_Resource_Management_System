<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\ReportService;
use Illuminate\Http\Request;

class ReportController
{

    private ReportService $reportService;

    public function __construct(
        ReportService $reportService
    ){
        $this->reportService = $reportService;
    }


    public function byPeriod(Request $request)
    {

        $type = $request->get('type','month');

        if($type == 'day'){

            $data = $this->reportService
                ->getTonsByDay(
                    $request->start_date,
                    $request->end_date
                );

        }elseif($type == 'week'){

            $data = $this->reportService
                ->getTonsByWeek(
                    $request->year ?? now()->year
                );

        }else{

            $data = $this->reportService
                ->getTonsByMonth(
                    $request->year ?? now()->year
                );

        }

        return view(
            'pages.reports.by-period',
            compact('data','type')
        );
    }


    // POR ZONA
    public function byZone(Request $request)
    {

        $data = $this->reportService
            ->getTonsByZone(
                $request->start_date,
                $request->end_date
            );

        return view(
            'pages.reports.by-zone',
            compact('data')
        );

    }


    // POR RUTA
    public function byRoute(Request $request)
    {

        $data = $this->reportService
            ->getTonsByRoute(
                $request->start_date,
                $request->end_date
            );

        return view(
            'pages.reports.by-route',
            compact('data')
        );

    }

    public function recycledByMaterial()
    {
        $data = $this->reportService
            ->getRecycledByMaterial();

        return view(
            'pages.reports.recycle-material',
            compact('data')
        );
    }

    public function mostActiveGreenPoints()
    {
        $data = $this->reportService
            ->getMostActiveGreenPoints();

        return view(
            'pages.reports.recycle-green-points',
            compact('data')
        );
    }

    public function recyclingTrend()
    {
        $data = $this->reportService
            ->getRecyclingTrend();

        return view(
            'pages.reports.recycle-trend',
            compact('data')
        );
    }

    public function complaintsStatus()
    {
        $data = $this->reportService
            ->getComplaintsStatusSummary();

        return view(
            'pages.reports.complaints-status',
            compact('data')
        );
    }

    public function complaintsAverageTime()
    {
        $data = $this->reportService
            ->getAverageAttentionTime();

        return view(
            'pages.reports.complaints-time',
            compact('data')
        );
    }

    public function complaintsCriticalZones()
    {
        $data = $this->reportService
            ->getCriticalZones();

        return view(
            'pages.reports.complaints-zone',
            compact('data')
        );
    }



}
