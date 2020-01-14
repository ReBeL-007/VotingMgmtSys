<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
// use App\Model\Voting\Organization;
// use App\Model\Voting\Position;
use App\Model\Voting\Candidate;
use App\Model\Voting\VoterList;
use Illuminate\Http\Request;
use Session;

class PagesController extends Controller
{
    //
    public function __construct(Candidate $candidate, VoterList $voterlist)
    {
        // $this->organization = $organization;
        $this->candidate = $candidate;
        $this->voterlist = $voterlist;
    }

    public function index(){
        // $organizations = $this->organization->all();
        // $positions = $this->position->all();
        $institutional_candidates = $this->candidate->where('type','institutional')->get();
        $individual_candidates = $this->candidate->where('type','individual')->get();
        return view('frontend.index', compact('institutional_candidates','individual_candidates'));
    }

    // public function castvoteorgn($id){
    //     // dd($id);
    //     $org = $this->organization->find($id);
    //     // dd($org->cvotes);
    //     $data['cvotes'] = $org->cvotes + 1;
    //     // dd($data['cvotes']);
    //     $org->update($data);
    // }

    public function castIndividualVote(Request $request){
        // dd($request->all());
        $memberships = $request->membership_no;
        foreach($memberships as $membership){
            // dd($membership);
            $candidate = $this->candidate->where('membership_no',$membership)->first();
            // dd($candidate->cvotes);
            $data['cvotes'] = $candidate->cvotes + 1;
            // dd($data['cvotes']);
            $candidate->update($data);
            $candidate->voters()->sync($request->voter_id);
        }
        Session::flash('flash_success', 'Congratulation... You have successfully voted!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('home');
    }
    
    public function checkAccessForIndividualVoting(Request $request){
        // dd($request->membership_no);
        // $this->validate($request,[            
        //     'membership_no' => 'required',
        // ]);
        $membership_no = $request->membership_no;
        $member = $this->voterlist->with('candidates')->where('membership_no',$membership_no)->first();
        // dd($member->candidates);
        
            if($member){
                    foreach($member->candidates as $candidate){
                        Session::flash('flash_danger', 'Sorry... You have already voted!.');
                        Session::flash('flash_type', 'alert-danger');
                        return redirect()->back();
                    }
                $individual_candidates = $this->candidate->where('type','individual')->get();
                $voter_id = $member->id;
                return view('frontend.index', compact('individual_candidates','voter_id'));
            }
            else{
                Session::flash('flash_danger', 'Sorry... You are not registered as member!.');
                Session::flash('flash_type', 'alert-danger');
                return redirect()->back();
            }
        }
    
}
