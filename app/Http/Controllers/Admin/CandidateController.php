<?php

namespace App\Http\Controllers\Admin;

use App\Model\Voting\Candidate;
use App\Model\Voting\Position;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CandidateController extends Controller
{
    public $model;
        
    public function __construct(Candidate $model, Position $position)
    {

        $this->model = $model;
        $this->position = $position;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('sd');
        $data = $this->model->with('positions')->paginate(10);
        $positions = $this->position->pluck('name','id');
        // dd($data->all());
        return view('backend.candidate.index', compact('data','positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required|unique:candidates',
            'position_id' => 'required',
        ]);

        $data = [
                    'name' => $request->name,
                    'position_id' => $request->position_id,
                ];
        $latest=$this->model->create($data);

        Session::flash('flash_success', 'candidate created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
        $model = $this->model->find($candidate->id);
        $data = $this->model->paginate(10);
        $positions = $this->position->pluck('name','id');
            
        return view('backend.candidate.index',compact('model','data','positions'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
        ]);

        $data = [
                    'name' => $request->name,
                ];

        $this->model->find($candidate->id)->update($data);
        Session::flash('flash_success', 'candidate updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('candidate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        // dd('candidate');
        $this->model->find($candidate->id)->delete();
        Session::flash('flash_danger', 'candidate has been deleted!.');
        Session::flash('flash_type', 'alert-danger');
        return redirect()->route('candidate.index');
    }
}
