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
            <h4 class="m-0 text-dark">Información de Usuario</h4>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<form action="{{ url('api/editUser') }}" method="POST" id="form">
  @csrf <!-- {{ csrf_field() }} -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- /.col-md-6 -->
          <div class="col-md-6">


            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Personal</h5>
              </div>
              <div class="card-body">

                  <input type="text" name="idu" value="{{ $usuario->id }}" style="display: none;">
                  <div class="form-group">
                    <center><img src="{{ url('dashboard/dist/img/avatar5.png') }}" style="width: 150px;" class="img-circle elevation-2" alt="User Image"></center>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{$usuario->nombre}}">
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" name="apellidoP" placeholder="Apellido Paterno" value="{{$usuario->apellidoP}}">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" name="apellidoM" placeholder="Apellido Materno" value="{{$usuario->apellidoM}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control disabled" name="email" placeholder="Correo electrónico" value="{{$usuario->email}}" disabled>
                  </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="curp" placeholder="CURP ó RFC" value="{{$usuario->curp}}">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="telefono" placeholder="Teléfono" value="{{$usuario->telefono}}">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="celular" placeholder="Celular" value="{{$usuario->celular}}">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="grado" placeholder="Grado Academico" value="{{$usuario->grado}}">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="certificacion" placeholder="Certificación" value="{{$usuario->certificacion}}">
                </div>
              </div>
              <div class="card-footer">
                <div class="form-group">
                  <select class="form-control select2" name="rol" style="width: 100%;">
                    <option @if ($usuario->rol == "3") {{ 'selected' }} @endif value="3">Socio Activo</option>
                    <option @if ($usuario->rol == "1") {{ 'selected' }} @endif value="1">Administrador</option>
                    <option @if ($usuario->rol == "2") {{ 'selected' }} @endif value="2">Socio</option>
                    <option @if ($usuario->rol == "4") {{ 'selected' }} @endif value="4">Medico residente</option>
                    <option @if ($usuario->rol == "5") {{ 'selected' }} @endif value="5">Invitado</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="contrasenaN" placeholder="Nueva Contraseña" value="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="confirmarN" placeholder="Confirmar Contraseña" value="">
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class=" card-title m-0">Laboral</h5>
              </div>
              <div class="card-body">

                  <input type="text" name="id" value="" style="display: none;">

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">Cédula de Medicina General</div><div class="col-md-6"> <input type="text" class="form-control" name="cedulaGeneral" placeholder="" value="{{$usuario->cedulaGeneral}}"></div></div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">Cédula de Medicina Familiar</div><div class="col-md-6">
                    <input type="text" class="form-control" name="cedulaFamiliar" placeholder="" value="{{$usuario->cedulaFamiliar}}"></div></div>
                  </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">Lugar de Trabajo</div><div class="col-md-6">
                  <input type="text" class="form-control" name="trabajo" placeholder="" value="{{$usuario->trabajo}}"></div></div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    Pendiente de recibir Constancia:<b style="margin-left:20px;">@if ($usuario->constancia) SI @else NO @endif</b>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    Trabaja en Medicina Privada:<b style="margin-left:20px;">@if ($usuario->privada) SI @else NO @endif</b>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    Promocionar en la Página de la Sociedad:<b style="margin-left:20px;">@if( $usuario->promocion) SI @else NO @endif</b>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="trabajoPrivado" placeholder="Lugar de Trabajo (Practica Privada)" value="{{$usuario->trabajoPrivado}}">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="infoPrivado" placeholder="Información de Practica Privada">{{$usuario->infoPrivado}}</textarea>
                </div>

              </div>
            </div>

            <input type="submit" name="" value="Editar" class="btn btn-info float-right" id="btnEditar">
            <input type="button" name="" value="Cancelar" class="btn btn-default float-right" style="margin: 0px 10px;" onclick="window.location='{{ url('/usuarios')}}'">


          </div>
          <!-- /.col-md-3 -->




        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</form>
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



<!-- jQuery -->
<script src="{{ url('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboard/dist/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('dashboard/plugins/toastr/toastr.min.js') }}"></script>

<script type="text/javascript">

  $(function() {

      $('#form').submit(function(event){
        $( "#btnEditar" ).prop( "disabled", true );
        $.ajax({
          url: $('#form').attr('action'),
          type: 'POST',
          data : $('#form').serialize(),
          dataType : 'json',
        }).done(function(data) {
          console.log(data);
          $( "#btnEditar" ).prop( "disabled", false );
          if (data.estatus == 0) {
            toastr.error(data.mensaje);
          }else{
            toastr.success(data.mensaje);
          }

                // here we will handle errors and validation messages
      });
        event.preventDefault();
    });


});

</script>

</body>
</html>
