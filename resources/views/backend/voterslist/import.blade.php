@extends('backend.layouts.master')

@section('title','Voters List')

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
                  Import Voters
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                    
                    {{ Form::open(['route' => 'voterslist.import', 'class' => 'form-horizontal', 'files'=> 'true', 'role' => 'form', 'method' => 'post']) }}
                                   
                    <div class="box box-primary">
                        
                        <div class="box-body">
                
                            <div class="form-group">
                              {{ Form::label('file','Voters: ', ['class' => 'control-label']) }}
              
                              <div class="col-lg-10  @if($errors->has('file')) has-error @endif ">
                                {{ Form::file('file', ['class'=> 'form-control']) }} 
                                  @if ($errors->has('file')) <p class="help-block">{{ $errors->first('file') }}</p> @endif
              
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
                                    {{ link_to_route('voterslist.import-export', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
                                   
                                    {{ Form::submit('Add', ['class' => 'btn btn-success btn-xs']) }}
                                  
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

      
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection