<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'lat',
        'lng',
        'estimated_kg',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
