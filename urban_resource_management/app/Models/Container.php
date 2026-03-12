<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{

    use HasFactory;

    protected $fillable = [
        'green_point_id',
        'material_type_id',
        'capacity_kg',
        'current_kg',
    ];

    public function greenPoint()
    {
        return $this->belongsTo(GreenPoint::class);
    }

    public function materialType()
    {
        return $this->belongsTo(MaterialType::class);
    }
}
