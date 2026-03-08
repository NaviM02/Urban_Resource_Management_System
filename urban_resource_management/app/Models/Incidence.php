<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'description'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

}
