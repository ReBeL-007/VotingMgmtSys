<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Voting\Candidate;

class PagesController extends Controller
{
    //
    public function __construct()   
    {
        $this->middleware('auth');
    }
    public function index(){
        // $total_votes = Candidate::select('name', 'cvotes')->where('type','institutional')->get();
        $institutional_votes = Candidate::selectRaw('sum(cvotes) as cvotes, name')->where('type','institutional')->groupBy('name')->get();
        $individual_votes = Candidate::selectRaw('sum(cvotes) as cvotes, name')->where('type','individual')->groupBy('name')->get();
        // dd($institutional_votes);
        return view('backend.index', compact('institutional_votes','individual_votes'));
    }
}
