<?php

namespace App\Models;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'status_id',
        'lat',
        'lng',
        'capacity_m3',
        'open_time',
        'close_time',
        'manager_user_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function deliveries()
    {
        return $this->hasMany(MaterialDelivery::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_user_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function (Builder $query) {
            $query->where('status_id', '!=', StatusEnum::DELETED);
        });
    }
}
