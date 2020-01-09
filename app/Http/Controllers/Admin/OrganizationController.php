<?php

namespace App\Http\Controllers\Admin;

use App\Model\Voting\Organization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class OrganizationController extends Controller
{
    public $model;
        
    public function __construct(Organization $model)
    {

        $this->model = $model;
    
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
        // dd($data);
        return view('backend.organization.index', compact('data'));
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
            'name' => 'required|unique:organizations',
        ]);

        $data = [
                    'name' => $request->name,
                ];
        $latest=$this->model->create($data);

        Session::flash('flash_success', 'Organization created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
        $model = $this->model->find($organization->id);
        $data = $this->model->paginate(10);
            
        return view('backend.organization.index',compact('model','data'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
        ]);

        $data = [
                    'name' => $request->name,
                ];

        $this->model->find($organization->id)->update($data);
        Session::flash('flash_success', 'Organization updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('organization.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        // dd('organization');
        $this->model->find($organization->id)->delete();
        Session::flash('flash_danger', 'Organization has been deleted!.');
        Session::flash('flash_type', 'alert-danger');
        return redirect()->route('organization.index');
    }
}
