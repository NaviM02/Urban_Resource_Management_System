<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'lat',
        'lng',
        'description',
        'dump_size',
        'citizen_id',
        'photo_path',
        'complaint_status_id',
        'complaint_date'
    ];

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function status()
    {
        return $this->belongsTo(ComplaintStatus::class, 'complaint_status_id');
    }

    public function assignment()
    {
        return $this->hasOne(ComplaintAssignment::class);
    }
}
