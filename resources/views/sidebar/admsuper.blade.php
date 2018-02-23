<aside class="sidebar" role="complementary">

  <div class="sidebar-block" style="">
    <div class="media">
      <div class="media-left">
        <a href="{{ route('home') }}">
          <img class="media-object img-circle" src="images/dummy/uifaces13.jpg" alt="photo profile">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Super User</h4>
        <p class="text-muted">
          <small><i class="fa fa-user fa-fw"></i> {{Auth::user()->name}}</small>
        </p>
      </div>
    </div>
  </div><!-- /.sidebar-block -->
  <!-- /profile -->

  <!-- /navigation -->
  <div class="nav-wrapper">
    <ul class="nav nav-stacked nav-left nav-tabs nav-contrast-teal" role="navigation">
      <li class="divider"></li>
      <li class="nav-header" role="presentation">ADMINISTRAR</li>
      <li class="nav-item" role="presentation">
        <a href="{{ route('users.index') }}">
          <span class="nav-icon"><i class="fa fa-users"></i></span>
          <span class="nav-text">Usuarios</span>
        </a>
      </li>
<li class="nav-item" role="presentation">
        <a href="{{ route('locals.index') }}">
          <span class="nav-icon"><i class="fa fa-building"></i></span>
          <span class="nav-text">Locales</span>
        </a>
      </li>
<li class="nav-item" role="presentation">
        <a href="{{ route('exeptuatedvehicles.index') }}">
          <span class="nav-icon"><i class="fa fa-car"></i></span>
          <span class="nav-text">Exceptuados</span>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="{{ route('areas.index') }}">
          <span class="nav-icon"><i class="fa fa-map"></i></span>
          <span class="nav-text">Zonas</span>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="{{ route('blocks.index') }}">
          <span class="nav-icon"><i class="fa fa-map-signs"></i></span>
          <span class="nav-text">Calles</span>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="{{ route('spacereservations.index') }}">
          <span class="nav-icon"><i class="fa fa-map-pin"></i></span>
          <span class="nav-text">Espacios</span>
        </a>
      </li>
      <li class="divider"></li>
      <li class="nav-header" role="presentation">CONTROL</li>
      <li class="nav-item" role="presentation">
        <a href="real_time_data.html">
          <span class="nav-icon"><i class="fa fa-location-arrow"></i></span>
          <span class="nav-text">Monitoreo</span>
        </a>
      </li><li class="nav-item" role="presentation">
        <a href="informs.html">
          <span class="nav-icon"><i class="fa fa-bar-chart"></i></span>
          <span class="nav-text">Informes</span>
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a href="messages.html">
          <span class="nav-icon"><i class="fa fa-envelope-o"></i></span>
          <span class="nav-text">Mensajes</span>
        </a>
      </li>
      <li class="divider"></li><li class="nav-header" role="presentation">OTROS</li><li class="nav-item" role="presentation">
        <a href="ayuda.html">
          <span class="nav-icon"><i class="fa fa-question-circle"></i></span>
          <span class="nav-text">Ayuda</span>
        </a>
      </li><li class="nav-item" role="presentation">
        <a href="terminos.html">
          <span class="nav-icon"><i class="fa fa-pencil-square-o"></i></span>
          <span class="nav-text">Términos y condiciones </span>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="login.html">
          <span class="nav-icon"><i class="fa fa-sign-out"></i></span>
          <span class="nav-text">Salir</span>
        </a>
      </li>
    </ul>
  </div>
</aside><!-- /.SIDEBAR -->
