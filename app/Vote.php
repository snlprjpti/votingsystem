<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'event_id',
        'can_id',
        'voter_id',
        'post_id',
    ];


    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

    public function candidate()
    {
        return $this->belongsTo('App\Candidate', 'can_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }

    public function voter()
    {
        return $this->belongsTo('App\User', 'voter_id', 'id');
    }
}
