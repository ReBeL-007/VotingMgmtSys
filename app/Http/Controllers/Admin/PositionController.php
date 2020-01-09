<?php

namespace App\Http\Controllers\Admin;

use App\Model\Voting\Position;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class PositionController extends Controller
{
    public $model;
        
    public function __construct(Position $model)
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
        return view('backend.position.index', compact('data'));
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
            'name' => 'required|unique:positions',
        ]);

        $data = [
                    'name' => $request->name,
                ];
        $latest=$this->model->create($data);

        Session::flash('flash_success', 'position created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
        $model = $this->model->find($position->id);
        $data = $this->model->paginate(10);
            
        return view('backend.position.index',compact('model','data'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
        ]);

        $data = [
                    'name' => $request->name,
                ];

        $this->model->find($position->id)->update($data);
        Session::flash('flash_success', 'position updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->route('position.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        // dd('position');
        $this->model->find($position->id)->delete();
        Session::flash('flash_danger', 'position has been deleted!.');
        Session::flash('flash_type', 'alert-danger');
        return redirect()->route('position.index');
    }
}
