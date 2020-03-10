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
            <h1 class="m-0 text-dark">Actividades Academicas</h1>
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
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Nueva actividad</h5>
              </div>
              <div class="card-body">
                <form action="{{ url('/api/actividades') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control" name="titulo" placeholder="Título">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="detalle" placeholder="Detalle"></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="link" placeholder="Lugar">
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="fechalimite" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <div class="input-group date" id="timepicker" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                    <input type="text" name="hora" class="form-control datetimepicker-input" data-target="#timepicker"/>

                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">

                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="imagen">
                      <label class="custom-file-label" for="exampleInputFile">Imagen (Opcional)</label>
                    </div>
                  </div>
                </div>


                <input type="submit" name="" value="Crear" class="btn btn-info float-right">
              </form>
              </div>
            </div>
          </div>
          <!-- /.col-md-3 -->

          <div class="col-lg-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Eventos Actuales</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 450px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Detalle</th>
                      <th>Lugar</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Imagen</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($activ as $sesion)
                    <tr style="height:70px;">

                        <td>{{$sesion->titulo}}</td>
                        <td>{{$sesion->detalle}}</td>
                        <td>{{$sesion->link}}</td>
                        <td>{{ date('d-m-Y', strtotime($sesion->fechalimite))}}</td>
                        <td>{{$sesion->hora}}</td>
                        <td style="text-align: center;">
                          @if($sesion->imagen)
                           <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick="verImagenEvento('{{ url('/public/'.$sesion->imagen)}}');">Ver Imagen</button>
                          @else
                          <button type="button" class="btn btn-default disabled" >Ver Imagen</button>
                          @endif
                        </td>
                        <td style="text-align: center;"> <a href="{{ url('/api/deleactiv/$sesion->id') }}" class="btn btn-danger">Eliminar</a> </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Imagen de evento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center><img src="#" id="imgEvento" width="200"></center>
                </div>
                <div class="modal-footer ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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



<!-- jQuery -->
<script src="{{ url('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboard/dist/js/adminlte.min.js') }}"></script>

<script src="{{ url('dashboard/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('dashboard/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{ url('dashboard/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
$(function () {

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()


  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT'
  })

  bsCustomFileInput.init();




})
function verImagenEvento( imgname){

  $('#imgEvento').attr('src',imgname);

}

</script>
</body>
</html>
