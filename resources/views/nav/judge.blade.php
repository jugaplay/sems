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
            <a aria-label="notifications" class="btn btn-icon navbar-btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa fa-inbox"></i>
              <span class="dotted dotted-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-ext dropdown-menu-right" role="menu" style="opacity: 0; display: none; transform: scaleX(1) scaleY(1) translateY(0px); transform-origin: 50% 50% 0px;">
              <div class="dd-head">
                <div class="dd-head-actions">
                  <a href="#" class="btn btn-xs btn-default">Mensajes</a>
                </div>
                <p><a href="#">Pendientes(2)</a></p>
              </div>
              <div class="dd-body">
                <ul class="media-list">

                  <li class="media" style="opacity: 1; display: list-item; transform: translateY(0px);">
                    <a href="#">
                      <div class="media-left">
                        <img class="media-object img-circle" width="32" src="{{URL::to('images/dummy/unknown-profile.jpg')}}" alt="user">
                      </div>
                      <div class="media-body">
                        <p class="pull-right"><small>18/12/2017 11:41</small></p>
                        <h4 class="media-heading body-text">Euge Barnett</h4>
                        <p>Assumenda, pariatur repellendus voluptatum eaque sint, quibusdam</p>
                      </div>
                    </a>
                    <span class="dd-actions">
                      <a href="#" title="" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="mark as unread"><i class="fa fa-circle"></i></a>
                    </span>
                  </li>
                  <li class="media" style="opacity: 1; display: list-item; transform: translateY(0px);">
                    <a href="#">
                      <div class="media-left">
                        <img class="media-object img-circle" width="32" src="{{URL::to('images/dummy/unknown-profile.jpg')}}" alt="user">
                      </div>
                      <div class="media-body">
                        <p class="pull-right"><small>16/12/2017 11:41</small></p>
                        <h4 class="media-heading body-text">Juan Gonzales</h4>
                        <p>Assumenda, pariatur repellendus voluptatum eaque sint, quibusdam</p>
                      </div>
                    </a>
                    <span class="dd-actions">
                      <a href="#" title="" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="mark as unread"><i class="fa fa-circle"></i></a>
                    </span>
                  </li>
                  <li class="media unread" style="opacity: 1; display: list-item; transform: translateY(0px);">
                    <a href="#">
                      <div class="media-left">
                        <img class="media-object img-circle" width="32" src="{{URL::to('images/dummy/unknown-profile.jpg')}}" alt="user">
                      </div>
                      <div class="media-body">
                        <p class="pull-right"><small>13/12/2017 11:41</small></p>
                        <h4 class="media-heading body-text">Ramiro Martinez</h4>
                        <p>Assumenda, pariatur repellendus voluptatum eaque sint, quibusdam</p>
                      </div>
                    </a>
                    <span class="dd-actions">
                      <a href="#" title="" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="mark as read"><i class="fa fa-circle-o"></i></a>
                    </span>
                  </li>
                  <li class="media unread" style="opacity: 1; display: list-item; transform: translateY(0px);">
                    <a href="#">
                      <div class="media-left">
                        <img class="media-object img-circle" width="32" src="{{URL::to('images/dummy/unknown-profile.jpg')}}" alt="user">
                      </div>
                      <div class="media-body">
                        <p class="pull-right"><small>12/12/2017 11:41</small></p>
                        <h4 class="media-heading body-text">David Martinez</h4>
                        <p>Assumenda, pariatur repellendus voluptatum eaque sint, quibusdam</p>
                      </div>
                    </a>
                    <span class="dd-actions">
                      <a href="#" title="" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="mark as read"><i class="fa fa-circle"></i></a>
                    </span>
                  </li>



                </ul>
              </div><!-- /.dd-body -->
            </div><!-- /.dropdown-menu -->
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
