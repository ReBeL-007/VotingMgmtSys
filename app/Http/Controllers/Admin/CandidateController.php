<?php

namespace App\Http\Controllers\Admin;

use App\Model\Voting\Candidate;
// use App\Model\Voting\Position;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Imports\ImportCandidates;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class CandidateController extends Controller
{
    public $model;
        
    public function __construct(Candidate $model)
    {

        $this->model = $model;
        // $this->position = $position;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('sd');
        $data = $this->model->paginate(10);
        // $positions = $this->position->pluck('name','id');
        // dd($data->all());
        return view('backend.candidate.index', compact('data'));
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
            'name' => 'required',
            'membership_no' => 'required|unique:candidates',
            'type' => 'required',
            // 'image' => 'required',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name= uniqid().'_'.$file->getClientOriginalName();
                // $imageName= $request->image->store('public/image');
                $file->move(public_path().'/images/candidates/', $file_name);
                // $image->move(public_path().'/images/', $name); 
                // $request->request->add(['image'=>$file_name]) ;
                $image = $file_name;
                // dd($request->all());
        }
        else{
            $image = null;
        }
        // $request->request->add(['name' => $request->name]) ;
        // $request->request->add(['membership_no' => $request->membership_no]) ;
        // $request->request->add(['type' => $request->type]) ;
        $data = [
                    'name' => $request->name,
                    'membership_no' => $request->membership_no,
                    'type' => $request->type,
                    'image' => $image,
                ];
                // dd($data);
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
        // $positions = $this->position->pluck('name','id');
            // dd($model);
        return view('backend.candidate.index',compact('model','data'));
    
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
            'membership_no' => 'required',
            'type' => 'required',
            // 'img' => 'required',
        ]);

        $candidate = $this->model->find($candidate->id);
        if($request->hasFile('image')){
            
        $dir = public_path().'/images/candidates/';
        if ($candidate->image != '' && File::exists($dir. $candidate->image));
             {
                 File::delete($dir . $candidate->image);
             }
            $file = $request->file('image');
            $file_name= uniqid().'_'.$file->getClientOriginalName();
                // $imageName= $request->image->store('public/image');
                $file->move($dir, $file_name);
                // $image->move(public_path().'/images/', $name); 
                // $request->request->add(['image'=>$file_name]) ;
                $image = $file_name;
                // dd($request->all());
        }
        // elseif ($request->remove == 1 && File::exists(public_path().'/images/candidates/' . $candidate->image)) {
        //     File::delete('uploads/' . $image->post_image);
        //     $image = null;
        // }
        elseif(isset($candidate->image)){
            // dd($candidate->image);
            $image = $candidate->image;
        }
        else{
            $image = null;
        }

        $data = [
                    'name' => $request->name,
                    'membership_no' => $request->membership_no,
                    'type' => $request->type,
                    'image' => $image,
                ];

        $candidate->update($data);
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

    public function importExport()
    {
       return view('backend.candidate.import');
    }

    public function import() 
    {
        Excel::import(new ImportCandidates, request()->file('file'));
            
        return back();
    }
}
