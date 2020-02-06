<?php

namespace App\Model\Voting;

use Illuminate\Database\Eloquent\Model;

class VoterList extends Model
{
    //
    protected $guarded = [];
    protected $table = 'voters_list';

    public function candidates(){
        return $this->belongsToMany(Candidate::class, 'candidate_voters','voter_id','candidate_id')->withPivot('voter_type');
    }
}
