@extends('access_form.layouts.master')

@section('content')
<div class="login-box" style="width:fit-content;">
  <div class="login-logo">
    <h2 style="color:#131c6b;">Management Association of Nepal</h2>
  </div>
  <div>
    @include('backend.includes.messages')
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3>Individual Voting :</h3>
    <hr>
    <p class="login-box-msg" style="color:red;">Enter membership id to vote...</p>
    {{-- @include('layouts.error') --}}

  <form action="{{ route('user.check.individual')}}" method="post">
        {{ csrf_field() }}
        
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="membership_no" placeholder="Membership No.">
      </div>
      
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ok</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>

  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection