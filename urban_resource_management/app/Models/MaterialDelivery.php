<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'green_point_id',
        'container_id',
        'quantity_kg',
        'user_id',
        'citizen_code',
        'delivered_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function greenPoint()
    {
        return $this->belongsTo(GreenPoint::class);
    }
}
