<?php

namespace App\Models;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'capacity_tons',
        'truck_status_id',
        'driver_name',
        'status_id',
    ];

    public function truckStatus()
    {
        return $this->belongsTo(TruckStatus::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function (Builder $query) {
            $query->where('status_id', '!=', StatusEnum::DELETED);
        });
    }

}
