<?php

namespace App\Model\Voting;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    //
    protected $guarded = [];

    public function positions(){
        return $this->belongsTo(Position::class, 'position_id');
    }
}
