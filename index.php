<?php require './inc/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('assets/') ?>index2.html"> <?php echo getSetting('appname');  ?> </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="myloginform">
        <input type="hidden" name="action" value="login" />
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input name="remember" value="yes" type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script>
          // Check for the page load event

          (function($){
            //alert('okokok');
            //$(selector).action()
            $('.myloginform').submit(function(e){
              e.preventDefault();
              //alert('Submited');
              var d = $(this).serialize(); // name=value&name=value.......
              //console.log(d);
              $.ajax({
                url:"<?php echo base_url('admin-ajax.php'); ?>",//kaha
                type:"POST",//kese
                data:d,//kya
                success:function(result,status,xhr){
                  //JSON String ---> JSON Object
                  console.log(result); //JSON string
                  result = JSON.parse(result);
                  console.log(result); //JSON Object

                  console.log(result.status); //JSON Object
                  if(result.status == 403){
                      //alert(result.msg);
                      swal("Invalid", result.msg, 'error');
                  }
                  if(result.status == 200){
                      //alert(result.msg);
                      swal("Success", result.msg, 'success');
                  }
                }
              });
            });
          })(jQuery);
</script>
</body>
</html>
