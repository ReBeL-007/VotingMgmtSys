<!DOCTYPE html>
<html lang="en">
  <head>
    @include('backend.layouts.head')

    <meta charset="utf-8">
    <title>Online Voting</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
          
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 620px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
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
    </style>
  </head>

  <body>
    <div class="container">
      <div class="row">
        
        <h1 style="color:#1e73be;">Management Association of Nepal</h1>
      </div>
      
      @if(isset ($institutional_candidates))
      <div class="content">
        <form class="form-horizontal" action="individual/vote">
          <input type="hidden" name="type" value="institutional">

        <div class="page-header">
          <div class="row">
          <h3 style="font-family:open sans"><b>Institutional Candidates</b></h3>
        </div>
        </div>
        <div class="form-group">
          <div class="span10 ">
            @foreach ($institutional_candidates as $candidate)
              <label class="labelHover answer" style="width:600px; border:1px solid #ddd; color:rgb(68, 68, 68); border-radius:4px; cursor:pointer; font-size: 25px; font-weight:400; margin: 5px;"> 
                <div class="icheck-success inline">
                  <input type="checkbox" name="membership_no" value="{{$candidate->membership_no}}" id="checkboxSuccess3">
                  <label for="checkboxSuccess3">
                  </label>
                  {{$candidate->name}}
                </div>
              </label>
            @endforeach
            </div>
        </div>
        <div class="clear"></div>
        
        <button type="submit" class="btn btn-block btn-success">Ok</button>
        </form>
      </div>
      @endif
      
      @if(isset ($individual_candidates))
      <div class="content">
        <form class="form-horizontal" action="{{ route('user.castIndividualVote')}}" method="post">
          {{ csrf_field() }}

          <input type="hidden" name="type" value="individual">
          <input type="hidden" name="voter_id" value="{{$voter_id}}">

        <div class="page-header">
          <div class="row">
          <h3 style="font-family:open sans"><b>Individual Candidates</b></h3>
        </div>
        </div>
        <div class="form-group">
          <div class="span10 ">
            @foreach ($individual_candidates as $candidate)
              <label class="labelHover answer" style="width:600px; border:1px solid #ddd; color:rgb(68, 68, 68); border-radius:4px; cursor:pointer; font-size: 25px; font-weight:400; margin: 5px;"> 
                <div class="icheck-success inline">
                  <input type="checkbox" name="membership_no[]" value="{{$candidate->membership_no}}" id="checkboxSuccess3">
                  <label for="checkboxSuccess3">
                  </label>
                  {{$candidate->name}}
                </div>
              </label>
            @endforeach
            </div>
        </div>
        <div class="clear"></div>
        
        <button type="submit" class="btn btn-block btn-success">Ok</button>
        </form>
      </div>
      @endif
    </div> <!-- /container -->

  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $(".answer").hover(function(){
    $(this).css("background-color", "#ddd");
    }, function(){
    $(this).css("background-color", "#fff");
  });
});

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

