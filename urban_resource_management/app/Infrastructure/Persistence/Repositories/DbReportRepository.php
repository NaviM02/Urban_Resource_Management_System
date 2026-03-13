<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Repositories\ReportRepository;
use Illuminate\Support\Facades\DB;

class DbReportRepository implements ReportRepository
{

    public function tonsByDay($startDate, $endDate)
    {
        return DB::table('collection_points')
            ->join('collections', 'collection_points.collection_id', '=', 'collections.id')
            ->selectRaw('collections.scheduled_date as date,
                         SUM(collection_points.estimated_kg)/1000 as tons')
            ->whereBetween('collections.scheduled_date', [$startDate, $endDate])
            ->groupBy('collections.scheduled_date')
            ->orderBy('collections.scheduled_date')
            ->get();
    }

    public function tonsByWeek($year)
    {
        return DB::table('collection_points')
            ->join('collections','collection_points.collection_id','=','collections.id')
            ->selectRaw('WEEK(collections.scheduled_date) as week,
                     SUM(collection_points.estimated_kg)/1000 as tons')
            ->whereYear('collections.scheduled_date',$year)
            ->groupByRaw('WEEK(collections.scheduled_date)')
            ->orderBy('week')
            ->get();
    }

    public function tonsByMonth($year)
    {
        return DB::table('collection_points')
            ->join('collections','collection_points.collection_id','=','collections.id')
            ->selectRaw('MONTH(collections.scheduled_date) as month,
                     SUM(collection_points.estimated_kg)/1000 as tons')
            ->whereYear('collections.scheduled_date',$year)
            ->groupByRaw('MONTH(collections.scheduled_date)')
            ->orderBy('month')
            ->get();
    }

    public function tonsByZone($startDate,$endDate)
    {
        return DB::table('collection_points')
            ->join('collections','collection_points.collection_id','=','collections.id')
            ->join('routes','collections.route_id','=','routes.id')
            ->join('zones','routes.zone_id','=','zones.id')
            ->selectRaw('zones.name as zone,
                     SUM(collection_points.estimated_kg)/1000 as tons')
            ->whereBetween('collections.scheduled_date',[$startDate,$endDate])
            ->groupBy('zones.name')
            ->orderBy('tons','desc')
            ->get();
    }

    public function tonsByRoute($startDate,$endDate)
    {
        return DB::table('collection_points')
            ->join('collections','collection_points.collection_id','=','collections.id')
            ->join('routes','collections.route_id','=','routes.id')
            ->selectRaw('routes.name as route,
                     SUM(collection_points.estimated_kg)/1000 as tons')
            ->whereBetween('collections.scheduled_date',[$startDate,$endDate])
            ->groupBy('routes.name')
            ->orderBy('tons','desc')
            ->get();
    }

    // GREEN POINT
    public function getRecycledByMaterial()
    {
        return DB::table('material_deliveries as md')
            ->join('containers as c','md.container_id','=','c.id')
            ->join('material_types as mt','c.material_type_id','=','mt.id')
            ->select(
                'mt.name as material',
                DB::raw('SUM(md.quantity_kg) as total_kg')
            )
            ->groupBy('mt.name')
            ->orderByDesc('total_kg')
            ->get();
    }

    public function getMostActiveGreenPoints()
    {
        return DB::table('material_deliveries as md')
            ->join('green_points as gp','md.green_point_id','=','gp.id')
            ->select(
                'gp.name as green_point',
                DB::raw('SUM(md.quantity_kg) as total_kg'),
                DB::raw('COUNT(md.id) as deliveries')
            )
            ->groupBy('gp.name')
            ->orderByDesc('total_kg')
            ->get();
    }

    public function getRecyclingTrend()
    {
        return DB::table('material_deliveries')
            ->select(
                DB::raw('DATE(delivered_at) as day'),
                DB::raw('SUM(quantity_kg) as total_kg')
            )
            ->groupBy(DB::raw('DATE(delivered_at)'))
            ->orderBy('day')
            ->get();
    }


}
