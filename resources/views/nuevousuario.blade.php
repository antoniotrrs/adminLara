<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Administrador | COMEFAENL</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/dashboard/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('dashboard/plugins/toastr/toastr.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @yield('sidebar',View::make('sidebar'));
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nuevo Usuario</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">E-mail</h5>
              </div>
              <div class="card-body">
                <form action="{{ url('/api/nuevousuario') }}" method="post" id="form">
                <p class="card-text" style="font-size:14px;">Ingrese un correo electrónico para registrar un nuevo miembro a COMEFAENL.</p><p class="card-text" style="font-size:14px;"> El usuario recibirá un email con su usuario y contraseña para ingresar a la aplicación y completar el registro.</p>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                  <select class="form-control select2" name="rol" style="width: 100%;">
                    <option selected="selected" value="3">Socio Activo</option>
                    <option value="1">Administrador</option>
                    <option value="2">Socio</option>
                    <option value="4">Medico residente</option>
                    <option value="5">Invitado</option>
                  </select>
                </div>
                <input type="submit" class="btn btn-info float-right" id="btnRegistro" value="Registrar">

              </form>
              </div>
            </div>


          </div>
          <!-- /.col-md-6 -->

          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Excel</h5>
              </div>
              <div class="card-body">

                <p class="card-text" style="font-size:14px;">Registre usuarios por medio de un archivo excel (.xlsx)</p><p class="card-text" style="font-size:14px;"> Los usuarios recibirán un email con su usuario y contraseña para ingresar a la aplicación y completar el registro.</p>

                <div class="form-group">
                  <!-- <label for="customFile">Custom File</label> -->

                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
                <input type="button" class="btn btn-info float-right" id="btnExcel" value="Registrar">


              </div>
            </div>


          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      version 2.0
    </div>
    <!-- Default to the left -->
    <strong>Powered by <a href="https://www.bats.com.mx">BATS</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ url('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboard/dist/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('dashboard/plugins/toastr/toastr.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script type="text/javascript">

  $(function() {
    bsCustomFileInput.init();

      $('#form').submit(function(event){
        $( "#btnRegistro" ).prop( "disabled", true );
        $.ajax({
          url: $('#form').attr('action'),
          type: 'POST',
          data : $('#form').serialize(),
          dataType    : 'json',
        }).done(function(data) {
          console.log(data);
          $( "#btnRegistro" ).prop( "disabled", false );
          if (data.estatus == 0) {
            toastr.error(data.mensaje);
          }else{
            toastr.success(data.mensaje);
          }

                // here we will handle errors and validation messages
      });
        event.preventDefault();
    });


    $("#btnExcel").click(function () {

      var file_data = $('#customFile').prop('files')[0];


      if (!file_data) {
        toastr.error("Seleccione un archivo Excel para subir");
      }

      var form_data = new FormData();

      form_data.append('filexcel', file_data);

      $.ajax({
          url:"{{ url('/api/subirexcel') }}",
          type:'POST',
          data: form_data,
          processData: false,
          contentType: false,
          dataType    : 'json',
        }).done(function(data) {
          if (data.estatus == 0) {
            toastr.error(data.mensaje);
          }else{
            toastr.success(data.mensaje);
          }
        });



    });


});

</script>
</body>
</html>
