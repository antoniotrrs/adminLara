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
  <link rel="stylesheet" href="{{url('dashboard/plugins/toastr/toastr.min.css')}}">
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
            <h1 class="m-0 text-dark">Asistencias de sesiones en vivo</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
            Selecciona una sesión para ver las asistencias.
            <div class="form-group">

              <select class="form-control" id="selectsesion">
                <option value="0">Selecciona una opción</option>
                @foreach($sesiones as $sesion)
                <option value="{{$sesion->id}}">{{$sesion->fecha_inicio}}</option>
                @endforeach
              </select>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

<div class="row">
  <div class="card">

    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Nombre</th>
            <th>Correo</th>
          </tr>
        </thead>
        <tbody id="tableasis">
          <!--<tr>
            <td>1.</td>
            <td>Update software</td>
            <td>

            </td>
          </tr>-->

        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

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
<script src="{{ url('dashboard/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{url('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script type="text/javascript">

$(function () {



  $("#table1").DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": false,
    "autoWidth": false,
  });

$(".dataTables_filter label").contents().eq(0).replaceWith('Buscar:');

  $("#selectsesion").change(function () {

      var select = $(this);
      var idses = select.val();

      $.ajax({
        url:'{{url("api/asisvivo")}}',
        type:'POST',
        data:{
          'idses':idses,
        },
        dataType: 'json',
      }).done(function(data){
        var html = data.tabla;
        $('#tableasis').replaceWith(html);

      });

  });


});

</script>
</body>
</html>
