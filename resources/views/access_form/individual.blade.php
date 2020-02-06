@extends('access_form.layouts.master')

@section('content')
<div class="login-box" style="width:fit-content;">
  <div class="login-logo row">
    <div class="col-md-3" id="container"><img src="{{ asset('public/images/logo.png')}}" width="150" height="150" class="center" alt="image"></div>
    <div class="col-md-9" style="color:#131c6b;"><h1>Management Association of Nepal</h1>
    <p style="font-size:26px;">19th Executive Committee Election Program - 2020</p>
    </div>
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
        
        {{-- <div class="form-group">
          <select name="type">
            <option value='general member'>General Member</option>
            <option value='life member'>Life Member</option>
          </select>
        </div> --}}
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