<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarEvent extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 
     */
    protected $guarded = [
        'id'
    ];

    /**
     * 
     */
    protected $hidden = [
        'id', 'deleted_at'
    ];

    /**
     * 
     */
    protected $casts = [
        'recurring_values' => 'json',
    ];
}
