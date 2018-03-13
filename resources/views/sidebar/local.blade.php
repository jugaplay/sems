<aside class="sidebar" role="complementary">

      <!-- profile -->


      <!-- profile -->
      <div class="sidebar-block" style="">
        <div class="media">
          <div class="media-left">
            <a href="{{ route('home') }}">
              <img class="media-object img-circle" src="images/dummy/uifaces14.jpg" alt="photo profile">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">{{Auth::user()->name}}</h4>
            <p class="text-muted">
              <small><i class="fa fa-map-marker fa-fw"></i> {{Auth::user()->local->address}}</small>
            </p>
          </div>
        </div>
      </div><!-- /.sidebar-block -->
      <!-- /profile -->

      <!-- /navigation -->
      <div class="nav-wrapper">
        <ul class="nav nav-stacked nav-left nav-tabs nav-contrast-teal" role="navigation">
          <li class="divider"></li>
          <li class="nav-header credit" role="presentation">SALDO</li>
          <li class="nav-item credit
          @if (Auth::user()->wallet->balance > 0)
              plus
          @else
              less
          @endif
                                        " role="presentation">
            <a href="load_credit.html">
              <span class="nav-text"><i class="fa fa-usd"></i> {{abs(intval(Auth::user()->wallet->balance))}}</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="nav-header" role="presentation">VENTAS</li>
          <li class="nav-item" role="presentation">
            <a href="{{ route('tickets.index') }}">
              <span class="nav-icon"><i class="fa fa-ticket"></i></span>
              <span class="nav-text">Tickets</span>
            </a>
          <li class="nav-item" role="presentation">
            <a href="{{ route('credit.index') }}">
              <span class="nav-icon"><i class="fa fa-money"></i></span>
              <span class="nav-text">Credito</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="nav-header" role="presentation">OTROS</li>
          <li class="nav-item" role="presentation">
            <a href="informs.html">
              <span class="nav-icon"><i class="fa fa-bar-chart"></i></span>
              <span class="nav-text">Informes</span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="ayuda.html">
              <span class="nav-icon"><i class="fa fa-question-circle"></i></span>
              <span class="nav-text">Ayuda</span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="contacto.html">
              <span class="nav-icon"><i class="fa fa-envelope-o"></i></span>
              <span class="nav-text">Contacto</span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="terminos.html">
              <span class="nav-icon"><i class="fa fa-pencil-square-o"></i></span>
              <span class="nav-text">Términos y condiciones </span>
            </a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <!-- El logut esta escondido en el navbar -->
              <span class="nav-icon"><i class="fa fa-sign-out"></i></span>
              <span class="nav-text">Salir</span>
            </a>
          </li>
        </ul>
      </div>
    </aside><!-- /.SIDEBAR -->
