<?php

namespace App\Models;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'zone_type_id',
    ];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function zoneType()
    {
        return $this->belongsTo(ZoneType::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function (Builder $query) {
            $query->where('status_id', '!=', StatusEnum::DELETED);
        });
    }
}
