<aside class="sidebar" role="complementary">
      <div class="sidebar-block" style="">
        <div class="media">
          <div class="media-left">
            <a href="page-profile.html">
              <img class="media-object img-circle" src="{{URL::to('images/dummy/uifaces20.jpg')}}" alt="photo profile">
            </a>
          </div>
          <div class="media-body"><a href="{{ route('login') }}">
            <h4 class="media-heading">Anonimo</h4>
            <p class="text-muted">
              <small><i class="fa fa fa-sign-in fa-fw"></i> Ingresar</small>
            </p></a>
          </div>
        </div>
      </div><!-- /.sidebar-block -->
      <!-- /profile -->

      <!-- /navigation -->
      <div class="nav-wrapper">
        <ul class="nav nav-stacked nav-left nav-tabs nav-contrast-teal" role="navigation">
          <li class="divider"></li>
          <li class="nav-header credit" role="presentation">SALDO</li>
          <li class="nav-item credit less" role="presentation">
            <a href="login.html">
              <span class="nav-text"><i class="fa fa-usd"></i> ...</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="nav-header" role="presentation">COMPRAR</li>
          <li class="nav-item" role="presentation">
            <a href="buy_tickets.html">
              <span class="nav-icon"><i class="fa fa-ticket"></i></span>
              <span class="nav-text">Tickets</span>
            </a>
          </li>
          <li class="divider"></li>
          <li class="nav-header" role="presentation">OTROS</li>

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
            <a href="{{ route('login') }}">
              <span class="nav-icon"><i class="fa fa-sign-in"></i></span>
              <span class="nav-text">Ingresar</span>
            </a>
          </li>
        </ul>
      </div>
    </aside><!-- /.SIDEBAR -->
    @push('scripts')
    <!-- COMPONENTES GRALES de Drivers -->
      <script>
        window.ajax_token = '{{ csrf_token() }}';
      </script>
    @endpush
