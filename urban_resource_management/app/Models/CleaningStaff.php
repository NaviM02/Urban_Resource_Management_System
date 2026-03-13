<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningStaff extends Model
{
    protected $table = 'cleaning_staff';

    protected $fillable = [
        'name',
        'phone',
        'available',
        'status_id'
    ];

    public function assignments()
    {
        return $this->belongsToMany(
            ComplaintAssignment::class,
            'assignment_staff',
            'cleaning_staff_id',
            'complaint_assignment_id'
        );
    }
}
