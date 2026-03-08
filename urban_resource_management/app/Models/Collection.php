<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_status_id',
        'route_id',
        'truck_id',
        'scheduled_date',
        'started_at',
        'finished_at',
        'estimated_waste_kg',
        'observations',
    ];

    public function collectionStatus()
    {
        return $this->belongsTo(CollectionStatus::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    public function points()
    {
        return $this->hasMany(CollectionPoint::class);
    }

    public function incidences()
    {
        return $this->hasMany(Incidence::class);
    }

}
