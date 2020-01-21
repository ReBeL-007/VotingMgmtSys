<?php

namespace App\Imports;

use App\Model\Voting\Candidate;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCandidates implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Candidate([
            //
            'name'     => @$row[0],
            'membership_no'    => @$row[1], 
            'type'    => @$row[2]
        ]);
    }
}
