<!DOCTYPE html>
<html lang="en">
  <head>
    @include('backend.layouts.head')

    <meta charset="utf-8">
    {{-- <title>Management Association of Nepal | MAN</title> --}}
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    {{-- <link href="bootstrap.css" rel="stylesheet"> --}}
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
          
        /* padding-top: 20px; 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        padding: 10px;
        margin: 0px 20px;
        width: fit-content; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }
      /* The white background content wrapper */
      .content {
        background-color: #fff;
        padding: 20px;
        /* min-height: 5000px; */
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
        -webkit-min-height: 500px;
            -moz-min-height: 500px;
                min-height: 500px;
      }
      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }
      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span10,
      .content .span4 {
        min-height: 300px;
        
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span4 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }
      .topbar .btn {
        border: 0;
      }
      .center {
        display: block;
        margin-left: auto;
        margin-right: auto; 
        width: 50%;
        /* height:fit-content; */
      }
      .center2 {
        display: block;
        margin-left: auto;
        margin-right: auto; 
        /* align-self: center; */
      }
      #container img {
        width: 100%;
        object-fit: contain;
      }
    </style>
<script>
  function checkBoxLimit() {
	var checkBoxGroup = document.forms['form_name']['membership_no[]'];		
  var type = document.getElementById('type').value;
  // console.log(type);
	var limit = 6;
  var limit2 = 11;
	for (var i = 0; i < checkBoxGroup.length; i++) {
		checkBoxGroup[i].onclick = function() {
			var checkedcount = 0;
			for (var i = 0; i < checkBoxGroup.length; i++) {
				checkedcount += (checkBoxGroup[i].checked) ? 1 : 0;
			}
      if(type == 'institutional'){
        if (checkedcount > limit) {
          console.log("You can select maximum of " + limit + " candidates.");
          alert("You can select maximum of " + limit + " candidates.");						
          this.checked = false;
        }
      }

      else{
        if (checkedcount > limit2) {
          console.log("You can select maximum of " + limit2 + " candidates.");
          alert("You can select maximum of " + limit2 + " candidates.");						
          this.checked = false;
        }
      }
		}
	}
}
</script>
  </head>

  <body>
    <div class="col-md-12 container">
      <div class="row">
        <div class="col-md-3">
        <img src="{{ asset('public/images/logo.png')}}" height="120" width="120" alt="logo">
        </div>
        <div class="col-md-9" style="color:#131c6b;">
        <h2>Management Association of Nepal</h2>
        <p style="font-size:22px;">19th Executive Committee Election Program - 2020</p>
        </div>
      </div>
      
      @if(isset ($institutional_candidates))
      <div class="content">
        <form class="form-horizontal" action="{{ route('user.castVote')}}" method="post" id="form_name">
          {{ csrf_field() }}
          <input type="hidden" name="type" id="type" value="institutional"> {{-- check --}}
          <input type="hidden" name="voter_id" value="{{$voter_id}}">
         {{-- <input type="hidden" name="voter_type" value="{{$voter_type}}">  update --}}
        <div class="page-header">
          <div class="row">
          <h5 style="font-family:open sans"><b>Institutional Candidates</b></h5>
          </div>
        </div>
        <div class="form-group">
          <div class="span10 row">
            @foreach ($institutional_candidates as $candidate)
            <div class="col-md-4">
              <label class="labelHover answer" style="width:inherit; border:1px solid #ddd; color:rgb(68, 68, 68); border-radius:4px; cursor:pointer; font-size: 20px; font-weight:400; margin: 5px;"> 
                <div class="icheck-success row inline" style="width:inherit; margin-left:10px;">
                  <input type="checkbox" name="membership_no[]" value="{{$candidate->membership_no}}" id="{{$candidate->id}}" />
                  <label for="{{$candidate->id}}">
                  </label>
                  <div class="col-md-3 row" id="container"><img src="{{ asset('public/images/candidates/'.$candidate->image)}}" class="user-image" height="90" width="90" alt="image"></div>
                  <div class="col-md-8 row" style="text-align:center">{{$candidate->name}}</div>
                </div>
              </label>
            </div>
            @endforeach
            </div>
        </div>
        
        <button type="submit" class="btn btn-block btn-success" onclick="return confirm('Are you sure?')">Ok</button>
        </form>
        <script type="text/javascript">checkBoxLimit()</script>
      </div>
      @endif
      
      @if(isset ($individual_candidates))
      <div class="content">
        <form class="form-horizontal" action="{{ route('user.castVote')}}" method="post" id="form_name">
          {{ csrf_field() }}

          <input type="hidden" name="type" id="type" value="individual">
          <input type="hidden" name="voter_id" value="{{$voter_id}}">
          {{-- <input type="hidden" name="voter_type" value="{{$voter_type}}">  update --}}
          
        <div class="page-header">
          <div class="row">
          <h5 style="font-family:open sans"><b>Individual Candidates</b></h5>
        </div>
        </div>
        <div class="form-group">
          <div class="span10 row">
            @foreach ($individual_candidates as $candidate)
            <div class="col-md-4">
              <label class="labelHover answer" style="width:inherit; border:1px solid #ddd; color:rgb(68, 68, 68); border-radius:4px; cursor:pointer; font-size: 20px; font-weight:400; margin: 5px;"> 
                <div class="icheck-success row inline" style="width:inherit; margin-left:10px;">
                  <input type="checkbox" name="membership_no[]" value="{{$candidate->membership_no}}" id="{{$candidate->id}}" />
                  <label for="{{$candidate->id}}">
                  </label>
                  <div class="col-md-3 row" id="container"><img src="{{ asset('public/images/candidates/'.$candidate->image)}}" class="user-image" height="90" width="90" alt="image"></div>
                  <div class="col-md-8 row">{{$candidate->name}}</div>
                </div>
              </label>
            </div>
            @endforeach
            </div>
        </div>
        
        <button type="submit" class="btn btn-block btn-success" onclick="return confirm('Are you sure?')">Ok</button>
        </form>
        <script type="text/javascript">checkBoxLimit()</script>
      </div>
      @endif
    </div> <!-- /container -->

  </body>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
  <script src="{{ asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
<script>
$(document).ready(function(){
  $(".answer").hover(function(){
    $(this).css("background-color", "#ddd");
    }, function(){
    $(this).css("background-color", "#fff");
  });
});


function checkBoxLimit() {
	var checkBoxGroup = document.forms['form_name']['membership_no[]'];			
	var limit = 2;
	for (var i = 0; i < checkBoxGroup.length; i++) {
		checkBoxGroup[i].onclick = function() {
			var checkedcount = 0;
			for (var i = 0; i < checkBoxGroup.length; i++) {
				checkedcount += (checkBoxGroup[i].checked) ? 1 : 0;
			}
			if (checkedcount > limit) {
				console.log("You can select maximum of " + limit + " checkboxes.");
				alert("You can select maximum of " + limit + " checkboxes.");						
				this.checked = false;
			}
		}
	}
}

// function castVote(id){
//   // console.log(vote);
//   // var id = vote;
//   $.ajax({
//           url: 'org/vote/' + id,
//           type: 'GET',

//           beforeSend: function (request) {
//               return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
//           },
//           success: function (response) {
//               console.log(response);
//               // location.reload();  
//               alert('Voting Successful');

//           }
//       });

// }
</script>
</html>

