<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintAssignment extends Model
{
    protected $fillable = [
        'complaint_id',
        'scheduled_date',
        'estimated_resources',
        'notes'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function staff()
    {
        return $this->belongsToMany(
            CleaningStaff::class,
            'assignment_staff',
            'complaint_assignment_id',
            'cleaning_staff_id'
        );
    }
}
