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
            <h1 class="m-0 text-dark">Enviar Notificacion</h1>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Nueva notificación</h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <label>Titulo</label>
                  <input type="text" class="form-control" placeholder="Escribe un titulo para la notificación" id="titulonoti">
                </div>
                <div class="form-group">
                  <label>Mensaje</label>
                  <textarea class="form-control" rows="3" placeholder="Mensaje ..." id="msnnoti"></textarea>
                </div>
                <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="sendall" checked>
                  <label class="form-check-label">Enviar a todos</label>
                </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Seleccionar Usuarios</button> <label id="cant-usr">{{count($usuarios)}}</label> Usuarios Seleccionados
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right" id="btnsendNot">Enviar Notificacion</button>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped" id="table1">
                    <thead>
                            <tr>
                                <th></th>
                                <th>E-mail</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                    <tbody>
                      @foreach($usuarios as $user)
                      <tr>
                        <td> <div class="form-check"><input class="form-check-input" type="checkbox" name="check_user" value="{{$user->firetoken}}" checked></div> </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->nombre}} {{$user->apellidoP}} {{$user->apellidoM}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnseleccion">Seleccionar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

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

  $("#btnseleccion").click(function () {

    $("#sendall").prop('checked',false);

    var favorite = [];
    $.each($("input[name='check_user']:checked"), function(){
          favorite.push($(this).val());
    });
    $("#cant-usr").text(favorite.length);
    //alert("Selected: " + favorite.join(", "));


  });


  $("#sendall").change(function (){
    var checkbx = $(this);
    if(checkbx.prop('checked')){
      var cont = 0;
      $.each($("input[name='check_user']"), function(){
            cont = cont +1;
            $(this).prop('checked',true);
      });
      $("#cant-usr").text(cont);
    }else{
      $.each($("input[name='check_user']"), function(){
            cont = cont +1;
            $(this).prop('checked',false);
      });
      $("#cant-usr").text("0");
    }
  });


  $("#btnsendNot").click(function () {

    var arraySelected = [];
    $.each($("input[name='check_user']:checked"), function(){
          arraySelected.push($(this).val());
    });

    if(arraySelected.length == 0){
      toastr.error("Selecciona al menos 1 usuario para enviar una notificación");
      return false;
    }

    if( $("#titulonoti").val() == "" || $("#msnnoti").val() == ""){
      toastr.error("Completa los campos para enviar la notificación");
      return false;
    }

    if($("#sendall").prop('checked')){
      arraySelected = [];

    }


    $.ajax({
      url:"{{ url('/api/sendnoti') }}",
      type:'POST',
      data:{
        'titulo':$("#titulonoti").val() ,
        'mensaje':$("#msnnoti").val(),
        'usuarios': JSON.stringify(arraySelected),
      },
      dataType:'json'
    }).done(function(data) {
      if(data.estatus == 0){
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
