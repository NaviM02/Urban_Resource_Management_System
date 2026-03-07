<?php

namespace App\Models;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'zone_id',
        'waste_type_id',
        'status_id',
        'lat_start',
        'lng_start',
        'lat_end',
        'lng_end',
        'path_coordinates',
        'distance_km',
        'collection_days',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'path_coordinates' => 'array'
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function (Builder $query) {
            $query->where('status_id', '!=', StatusEnum::DELETED);
        });
    }
}
