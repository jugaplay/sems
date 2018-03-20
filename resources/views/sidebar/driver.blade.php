<aside class="sidebar" role="complementary">

      <!-- profile -->


      <!-- profile -->
      <div class="sidebar-block" style="">
        <div class="media">
          <div class="media-left">
            <a href="{{ route('home') }}">
              <img class="media-object img-circle" src="{{URL::to('images/dummy/uifaces19.jpg')}}" alt="photo profile">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">{{Auth::user()->name}}</h4>
            <p class="text-muted nick">
              <small><i class="fa fa-envelope-o fa-fw"></i> {{Auth::user()->email}}</small>
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
          <li class="nav-item credit plus" role="presentation">
            <a href="load_credit.html">
              <span class="nav-text"><i class="fa fa-usd"></i> 400.27</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="nav-header" role="presentation">Comprar</li>
          <li class="nav-item" role="presentation">
            <a href="buy_tickets.html">
              <span class="nav-icon"><i class="fa fa-ticket"></i></span>
              <span class="nav-text">Tickets</span>
            </a>
          </li><li class="nav-item" role="presentation">
            <a href="load_credit.html">
              <span class="nav-icon"><i class="fa fa-money"></i></span>
              <span class="nav-text">Saldo</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="nav-header" role="presentation">OTROS</li>

<li class="nav-item" role="presentation">
            <a href="vouchers.html">
              <span class="nav-icon"><i class="fa fa-search"></i></span>
              <span class="nav-text">Comprobantes</span>
            </a>
          </li>
<li class="nav-item" role="presentation">
            <a href="configuration.html">
              <span class="nav-icon"><i class="fa fa-cog"></i></span>
              <span class="nav-text">Configuración</span>
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
              <span class="nav-icon"><i class="fa fa-sign-out"></i></span>
              <span class="nav-text">Salir</span>
            </a>
          </li>
        </ul>
      </div>
    </aside><!-- /.SIDEBAR -->
