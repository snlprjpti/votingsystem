<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_name',
        'details',
        'status',
        'event_date',
        'organizer_id',
    ];


    public function organizer()
    {
        return $this->belongsTo('App\User', 'organizer_id', 'id');
    }
}
