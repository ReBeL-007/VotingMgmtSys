<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\Voting\Organization;
use App\Model\Voting\Position;
use App\Model\Voting\Candidate;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function __construct(Organization $organization, Candidate $candidate, Position $position)
    {
        $this->organization = $organization;
        $this->candidate = $candidate;
        $this->position = $position;
    }

    public function index(){
        $organizations = $this->organization->all();
        return view('frontend.index', compact('organizations'));
    }

    public function castvoteorgn($id){
        // dd($id);
        $org = $this->organization->find($id);
        // dd($org->cvotes);
        $data['cvotes'] = $org->cvotes + 1;
        // dd($data['cvotes']);
        $org->update($data);
    }
}
