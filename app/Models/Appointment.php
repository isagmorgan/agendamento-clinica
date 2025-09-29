<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id','patient_id','date','time','duration_minutes','status','notes'
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
