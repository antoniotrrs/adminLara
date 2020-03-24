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
            <h1 class="m-0 text-dark">Sesiones</h1>
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
                <h5 class="m-0">Nueva Sesión</h5>
              </div>
              <div class="card-body">
                <form action="{{ url('/api/sesiones') }}" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="mes" placeholder="Mes">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="titulo" placeholder="Título">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="ponente" placeholder="Ponente"></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="video" placeholder="Url video">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="pdf" placeholder="Url PDF">
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
                      <th>Mes</th>
                      <th>Título</th>
                      <th>Ponente</th>
                      <th style="width:100px;">Video</th>
                      <th>PDF</th>


                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sesions as $sesion)
                    <tr style="height:90px;">

                        <td>{{$sesion->mes}}</td>
                        <td><p class="text-wrap" style="width:300px;">{{$sesion->titulo}}</p></td>
                        <td><p class="text-wrap" style="width:300px;">{{$sesion->ponente}}</p></td>
                        <td><a href="{{$sesion->video}}" target="_blank">{{$sesion->video}}</a></td>
                        <td><a href="{{$sesion->pdf}}" target="_blank">{{$sesion->pdf}}</a></td>
                        <td > <ul style="padding: 0; list-style: none; margin: 0px;"><li style="margin-bottom:10px;"><a class="btn btn-warning btn-block" href="{{ url('/editarsesion/'.$sesion->id) }}">Editar</a></li><li><a class="btn btn-danger btn-block" href="{{ url('/api/deleteSesion/'.$sesion->id) }}">Eliminar</a></li></ul> </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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


</body>
</html>
