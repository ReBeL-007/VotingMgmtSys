<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Voting\VoterList;
use Session;
use App\Imports\ImportVoters;
use Maatwebsite\Excel\Facades\Excel;

class VotersListController extends Controller
{

    public $model;
        
    public function __construct(VoterList $model)
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
        //
        $data = $this->model->paginate(10);
        
        return view('backend.voterslist.index', compact('data'));
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
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'membership_no' => 'required|unique:voters_list',
            'type' => 'required',
            // 'img' => 'required',
        ]);

            // if($request->hasFile('image')){
            //     $file = $request->file('image');
            //     $file_name= uniqid().'_'.$file->getClientOriginalName();
            //     // $imageName= $request->image->store('public/image');
            //     $file->move(public_path().'/images/voterslist/', $file_name);
            //     // $image->move(public_path().'/images/', $name);  
            //     $image = $file_name;
            // }
            // else{
            //     $image = null;
            // }

        $data = [
                    'name' => $request->name,
                    'membership_no' => $request->membership_no,
                    'type' => $request->type,
                    // 'image' => $image,
                ];
        $latest=$this->model->create($data);

        Session::flash('flash_success', 'voters created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $model = $this->model->find($id);
        $data = $this->model->paginate(10);
        // $positions = $this->position->pluck('name','id');
            
        return view('backend.voterslist.index',compact('model','data'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name' => 'required',
            'membership_no' => 'required',
            'type' => 'required',
            // 'img' => 'required',
        ]);

        $data = [
                    'name' => $request->name,
                    'membership_no' => $request->membership_no,
                    'type' => $request->type,
                    // 'img' => $request->img,
                ];
        $this->model->find($id)->update($data);

        Session::flash('flash_success', 'voters updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('voterslist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->model->find($id)->delete();
        Session::flash('flash_danger', 'voters has been deleted!.');
        Session::flash('flash_type', 'alert-danger');
        return redirect()->route('voterslist.index');
    }

    public function importExport()
    {
       return view('backend.voterslist.import');
    }

    public function import() 
    {
        Excel::import(new ImportVoters, request()->file('file'));
            
        return back();
    }
}
