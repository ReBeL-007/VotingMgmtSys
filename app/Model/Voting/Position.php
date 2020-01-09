<?php

namespace App\Model\Voting;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //
    protected $guarded = [];

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }
}
