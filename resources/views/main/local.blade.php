<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div class="content-hero content-hero-lg">
            <img class="content-hero-embed" src="images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
            </div>
            <div class="content-hero-bar">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="float-bar clearfix">
                            <div class="float-bar-brand">
                                <a class="kit-avatar kit-avatar-128 no-padding border-white" href="#">
                                    <img alt="cover" src="images/dummy/uifaces14.jpg">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="visible-xs">
                                    <h2 class="display-name media-heading text-teal">{{Auth::user()->name}}</h2>
                                    <p class="text-muted mb-4x">
                                        <i class="fa fa-map-marker fa-fw"></i> {{Auth::user()->local->address}}</span>
                                    </p>
                                </div>
                                <div class="hidden-xs">
                                    <h2 class="media-heading text-light">{{Auth::user()->name}}</h2>
                                    <p class="mb-4x text-light">
                                        <span>
                                            <i class="fa fa-map-marker fa-fw"></i> {{Auth::user()->local->address}}</span>
                                    </p>
                                </div>
                                <div class="mt-4x">
                                    <p>
                                        <i class="fa fa-phone" aria-hidden="true"></i> {{Auth::user()->phone}}</p>
                                    <p>
                                      @switch(Auth::user()->account_status)
                                        @case("C")
                                            <p><i class="fa fa-check-square-o" aria-hidden="true"></i> Habilitado</p>
                                            @break
                                        @case("N")
                                            <p><i class="fa fa-share-square-o" aria-hidden="true"></i> Falta confirmar mail</p>
                                            @break
                                        @default
                                            <p><i class="fa fa-times" aria-hidden="true"></i> No habilitado</p>
                                    @endswitch
                                    @switch(Auth::user()->local->verified)
                                      @case(1)
                                          <p><i class="fa fa-check-square-o" aria-hidden="true"></i> Verificado</p>
                                          @break
                                      @default
                                          <p><i class="fa fa-share-square-o" aria-hidden="true"></i> Falta verificar</p>
                                  @endswitch
                                </div>
                            </div>
                            <!-- /.media-body -->
                        </div>
                        <!-- /.float-bar -->
                    </div>
                    <!-- /.cols -->

                    <div class="col-lg-6">
                        <h4 class="text-muted">Billetera</h4>
                        <div class="row">

                            <div class="col-xs-6">
                                <span class="headline credit
                                @if (Auth::user()->wallet->balance > 0)
                                    plus
                                @else
                                    less
                                @endif
                                " style="background: transparent;">
                                    <strong>$ {{abs(intval(Auth::user()->wallet->balance))}}</strong>
                                </span>
                                <p>SALDO</p>
                            </div>
                            <div class="col-xs-6">
                                <span class="headline">
                                    <strong>${{abs(intval(Auth::user()->wallet->credit))}}</strong>
                                </span>
                                <p>CREDITO</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.cols -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.content-hero-bar -->
        </div>
        <!-- /.content-hero -->

        <div class="content-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="{{ route('tickets.index') }}" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-blue"></i>
                                            <i class="fa fa-ticket fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Vender tickets</h3>
                                        <p class="help-block">Horas o estadias</p>
                                    </div>
                                    <!-- /.media -body-->
                                </div>
                                <!-- /.media -->
                            </div>
                            <!-- /.panel-body -->

                            <div class="progress progress-xs no-radius no-margin">
                                <div class="progress-bar bg-grd-teal" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <!-- /.progress -->
                        </div>
                        <!-- /.panel -->
                    </a>
                </div>
                <!-- /.cols -->

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="sell_credit.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-red"></i>
                                            <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Vender Credito</h3>
                                        <p class="help-block">Recargue billeteras</p>
                                    </div>
                                    <!-- /.media -body-->
                                </div>
                                <!-- /.media -->
                            </div>
                            <!-- /.panel-body -->

                            <div class="progress progress-xs no-radius no-margin">
                                <div class="progress-bar bg-grd-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <!-- /.progress -->
                        </div>
                        <!-- /.panel -->
                    </a>
                </div>
                <!-- /.cols -->

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="load_credit.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-cyan"></i>
                                            <i class="icon-rocket fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Recargar Saldo</h3>
                                        @if (Auth::user()->wallet->balance > 0)
                                            <p class="help-block">Consumidos $0 de {{abs(intval(Auth::user()->wallet->credit))}}</p>
                                        @else
                                            <p class="help-block">Consumidos ${{abs(intval(Auth::user()->wallet->balance))}} de {{abs(intval(Auth::user()->wallet->credit))}}</p>
                                        @endif

                                    </div>
                                    <!-- /.media -body-->
                                </div>
                                <!-- /.media -->
                            </div>
                            <!-- /.panel-body -->

                            <div class="progress progress-xs no-radius no-margin">
                              @if (Auth::user()->wallet->balance > 0)
                              <div class="progress-bar bg-grd-cyan" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                              @else
                                  <div class="progress-bar bg-grd-cyan" role="progressbar" aria-valuenow="{{100-abs(intval(Auth::user()->wallet->balance/Auth::user()->wallet->credit*100))}}" aria-valuemin="0" aria-valuemax="100" style="width: {{100-abs(intval(Auth::user()->wallet->balance/Auth::user()->wallet->credit*100))}}%"></div>
                              @endif
                            </div>
                            <!-- /.progress -->
                        </div>
                        <!-- /.panel -->
                    </a>
                </div>
                <!-- /.cols -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
