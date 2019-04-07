<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'post_id',
        'candidate_name',
        'organizer_id'
    ];


    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
