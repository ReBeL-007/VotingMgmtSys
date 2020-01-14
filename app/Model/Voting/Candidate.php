<?php

namespace App\Model\Voting;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    //
    protected $guarded = [];

    // public function positions(){
    //     return $this->belongsTo(Position::class, 'position_id');
    // }

    public function voters(){
        return $this->belongsToMany(VoterList::class, 'candidate_voters','candidate_id','voter_id');
    }
}
