<!-- jQuery 3 -->
<script src="{{ asset('public/login/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/login/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('public/login/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script>
  $(document).ready(function(){
      setTimeout(function(){
         $(".alert").remove();
      }, 5000 ); // 5 secs
  
  });
  </script>