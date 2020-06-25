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
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
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
            <h1 class="m-0 text-dark">Usuarios Registrados</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-12">
            <div class="card" style="padding:1rem;">

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap" id="tablausu">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Rol</th>
                      <th></th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($event as $user)
                    <tr>

                        <td>{{$user->nombre}} {{$user->apellidoP}} {{$user->apellidoM}}</td>
                        <td> {{$user->email}}</td>
                        <td>@switch($user->rol)
                              @case(1)
                                  Administrador
                                  @break
                              @case(2)
                                  Socio
                                  @break
                              @case(3)
                                  Socio Activo
                                  @break
                              @case(4)
                                  Medico residente
                                  @break
                              @case(5)
                                  Invitado
                                  @break
                              @default
                                  Usuario sin rol
                          @endswitch</td>
                        <td><a class="btn btn-warning btn-block" href="{{url('/usuario/'.$user->id)}}">Ver</a> </td>

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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ url('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboard/dist/js/adminlte.min.js') }}"></script>
<script src="{{url('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script>


$(function() {


$("#tablausu").DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": true,
  "ordering": false,
  "info": false,
  "autoWidth": true,
});

$(".dataTables_filter label").contents().eq(0).replaceWith('Buscar:');
});
</script>
</body>
</html>
