<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_name',
        'organizer_id',
    ];


    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

}
