<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="top-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <p class="bold text-left" v-text="$root.date()"></p>
                </div>
                <div class="col-sm-6 col-md-6">
                    @guest
                    <a href="#" style="margin-left: 2%;" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#acceder">Ingresar</a>
                    <a href="#" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#registro">Crear Cuenta</a>
                    @else

                    <!-- cerrar sesion -->
                    <a data-toggle="tooltip" title="Cerrar Sesión" href="{{ route('logout') }}" 
                        style="margin-left: 2%;" 
                        class="btn btn-xs btn-primary pull-right" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!-- /cerrar sesion -->

                    <!-- usuario -->
                    <a href="{{url('/web/historial')}}" style="margin-left: 2%;" class="btn btn-xs btn-primary pull-right">Historial</a>
                    
                    <a href="{{url('/web/usuario')}}" class="btn btn-xs btn-primary pull-right">Usuario</a>
                    <!-- /usuario -->
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <div class="container navigation">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('website/img/logo.png') }}" alt="" width="150" height="40" />
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ request()->is('/')?'active':'' }}"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="{{ request()->is('servicios')?'active':'' }}"><a href="{{ url('servicios') }}">Servicios</a></li>
            <li class="{{ request()->is('noticias')?'active':'' }}"><a href="{{ url('noticias') }}">Noticias</a></li>
            <li class="{{ request()->is('eventos')?'active':'' }}"><a href="{{ url('eventos') }}">Eventos</a></li>
            <li class="{{ request()->is('contacto')?'active':'' }}"><a href="{{ url('contacto') }}">Contactanos</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge custom-badge red pull-right">Extra</span>Más <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('convenios') }}">Convenios</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Modal -->
  <div class="modal fade" id="acceder" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="h4 text-center modal-title">Iniciar Sesión</p>
        </div>
        <div class="modal-body">
            <ingresar-component></ingresar-component>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registro" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="h5 text-center modal-title">Registrar</p>
        </div>
        <div class="modal-body">
          <usuario-component></usuario-component>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->