<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador | COMEFAENL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dashboard/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('dashboard/plugins/toastr/toastr.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <img src="{{ url('/public/images/colegioTrans.png') }}" style="width: 150px;">
      </div>

      <form action="{{url('/login')}}" method="post" id="form">
        @csrf <!-- {{ csrf_field() }} -->
        <div class="input-group mb-3">
          <input  class="form-control" placeholder="Correo electrónico" name="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <center><button type="submit" id="btnSesion" class="btn btn-info" >Iniciar Sesión</button></center>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboard/dist/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ url('dashboard/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">

  $(function() {

var diretsion = "{{ url('/allevents') }}";
      $('#form').submit(function(event){
        $( "#btnSesion" ).prop( "disabled", true );
        $.ajax({
          url: $('#form').attr('action'),
          type: 'POST',
          data : $('#form').serialize(),
          dataType    : 'json',
        }).done(function(data) {
          console.log(data);
          $( "#btnSesion" ).prop( "disabled", false );
          if (data.estatus == 0) {
            toastr.error(data.mensaje);
          }else{
            window.location = diretsion;
          }

                // here we will handle errors and validation messages
      });
        event.preventDefault();
    });


});

</script>

</body>
</html>
