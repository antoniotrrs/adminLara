<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
  <img src="{{ url('public/images/colegioTrans.png')}}" alt="COMEFAENL Logo" class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">COMEFAENL</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      @if ($_SESSION['img'] != "")
      <img src="{{ url('public/' . $_SESSION['img'])}}" class="img-circle elevation-2" alt="User Image">
      @else
      <img src="{{ url('dashboard/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
      @endif
    </div>
    <div class="info">
      <a href="#" class="d-block">{{$_SESSION['name']}}</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

       <li class="nav-item">
         <a href="{{ url('/sesionlive') }}" class="nav-link">
           <i class="nav-icon fas fa-video"></i>
           <p>
             Sesion en Vivo
           </p>
         </a>
       </li>

      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link">
          <i class="nav-icon fas fa-calendar-alt"></i>
          <p>
            Eventos
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('/sesiones') }}" class="nav-link">
          <i class="nav-icon fas fa-chalkboard"></i>
          <p>
            Sesiones
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ url('/actividades') }}" class="nav-link">
          <i class="nav-icon fas fa-atom"></i>
          <p>
            Actividades Academicas
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('/biblioteca')}}" class="nav-link">
          <i class="nav-icon fas fa-book-open"></i>
          <p>
            Biblioteca
          </p>
        </a>
      </li>

          <li class="nav-item">
            <a href="{{ url('/usuarionuevo') }}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>Registrar usuario</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/usuarios')}}" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">
              <i class="fas fa-bell nav-icon"></i>
              <p>Notificaciones</p>
            </a>
          </li>




      <li class="nav-item">
        <a href="{{ url('/home') }}" class="nav-link">
          <i class="nav-icon fas fa-power-off"></i>
          <p>
            Cerrar Sesión
          </p>
        </a>
      </li>



    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
