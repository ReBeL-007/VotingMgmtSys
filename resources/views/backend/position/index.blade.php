@extends('backend.layouts.master')

@section('title','Position')

@section('content')

<!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Add Position
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                    @if(isset ($model))
                    {{ Form::model($model, ['route' => ['position.update', $model], 'class' => 'form-horizontal', 'files'=> 'true', 'role' => 'form', 'method' => 'PATCH']) }}
                    @else
                    {{ Form::open(['route' => 'position.store', 'class' => 'form-horizontal', 'files'=> 'true', 'role' => 'form', 'method' => 'post']) }}
                    @endif
                
                    <div class="box box-primary">
                        
                        <div class="box-body">
                
                            <div class="form-group">
                                <div class="col-lg-4 pull-left inline">
                                {{ Form::label('name','Position :', ['class' => 'control-label']) }}
                                </div>
                                <div class="col-lg-10 pull-right ">
                                    {{ Form::text('name', NULL, ['class' => 'form-control', 'placeholder' =>'Enter the Position']) }}
                                    @if ($errors->has('name')) <p class="help-block" style="color:red;">{{ $errors->first('name') }}</p> @endif
                
                                </div>
                                <!--col-lg-10-->
                            </div>
                            <!--form control-->
                        </div>
                        <div class="box box-info">
                            <div class="box-body">
                                {{-- <div class="pull-left">
                                    
                                </div> --}}
                                <!--pull-left-->
                
                                <div class="pull-right">
                                    {{ link_to_route('position.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                                    @if(isset($model))
                                    {{ Form::submit('Update', ['class' => 'btn btn-info btn-xs']) }}
                                    @else
                                    {{ Form::submit('Add', ['class' => 'btn btn-success btn-xs']) }}
                                    @endif
                                </div>
                                <!--pull-right-->
                
                                <div class="clearfix"></div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  List of Positions
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="box-body">
                  <div class="table-responsive">
                      <table id="users-table" class="table table-condensed table-hover">
                          <thead>
                              <tr>
                                  <th>SN</th>
                                  <th>Position</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              
                              @foreach($data as $field)
                              <tr>
                                  <td>{!! $loop->index + 1 !!}</td>
                                  <td>{!! $field->name !!}</td>
                                  <td class="col-md-1">
                                    
                                      {!! link_to_route('position.edit', '||', array($field->id), 
                                      array('class' => 'fas fa-pencil-alt')) !!}
                                      {!! link_to_route('position.destroy', '', array($field->id),
                                      array('class' => 'fa fa-trash','onclick'=>"return confirm('Are you sure?')")) !!}
                                  </td>
      
                                  {!! Form::close() !!}
      
      
                              </tr>
                              @endforeach
                          </tbody>
                          {!!$data->render() !!}
                      </table>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection