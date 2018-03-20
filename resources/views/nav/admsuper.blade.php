<nav class="header navbar">
  <div class="container-fluid">
    <!-- use .pull-*, couse we need this float on any screen size -->
    <div class="pull-left">

      <button data-sidebar="toggleVisible" class="btn btn-icon navbar-btn">
        <i class="fa fa-bars"></i>

      </button><a class="navbar-brand"  href="#" role="logo" aria-label="Logo">
        <img class="logo" src="{{URL::to('images/logo/brand-text-color.png')}}" alt="Brand 3">
      </a>
    </div>

    <!-- use .pull-*, couse we need this float on any screen size -->
    <div class="pull-right" role="navigation">


      <div class="dropdown-ext">
        <a aria-label="notifications" class="btn btn-icon navbar-btn" href="#">
          <i class="fa fa fa-inbox"></i>
          <span class="dotted dotted-danger"></span>
        </a>

      </div><!-- /.dropdown -->

      <div class="dropdown">
        <a aria-label="More" class="btn btn-icon navbar-btn dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="fa fa-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" style="opacity: 0; display: none; transform: scaleX(1) scaleY(1) translateY(0px); transform-origin: 50% 50% 0px;">
          <li role="presentation" class="" style="opacity: 1; display: list-item; transform: translateY(0px);"><a role="menuitem" tabindex="-1" href="{{ route('home') }}"><span class="pull-right"><i class="fa fa-user text-muted"></i></span>Inicio</a></li>
          <li class="divider" style="opacity: 1; display: list-item; transform: translateY(0px);"></li>
          <li role="presentation" class="" style="opacity: 1; display: list-item; transform: translateY(0px);"><a role="menuitem" tabindex="-1" href="ayuda.html"><span class="pull-right"><i class="fa fa-question-circle text-muted"></i></span>Ayuda</a></li>
          <li class="divider" style="opacity: 1; display: list-item; transform: translateY(0px);"></li>
          <li role="presentation" class="" style="opacity: 1; display: list-item; transform: translateY(0px);"><a role="menuitem" tabindex="-1" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="pull-right"><i class="fa fa-sign-out text-muted"></i></span>Salir</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </div><!-- /.dropdown -->
    </div><!-- /navigation -->


  </div><!-- /.container-fluid -->
</nav><!-- /navigation -->
