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
                                    <img alt="cover" src="images/dummy/uifaces13.jpg">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="visible-xs">
                                    <h2 class="display-name media-heading text-teal">Super User</h2>
                                    <p class="text-muted mb-4x">
                                        <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}}</p>
                                </div>
                                <div class="hidden-xs">
                                    <h2 class="media-heading text-light">Super User</h2>
                                    <p class="mb-4x text-light">
                                        <span>
                                            <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}}</span>
                                    </p>
                                </div>
                                <div class="mt-4x">
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
                                </div>
                            </div>
                            <!-- /.media-body -->
                        </div>
                        <!-- /.float-bar -->
                    </div>
                    <!-- /.cols -->

                    <div class="col-lg-6">
                        <h4 class="text-muted">Activos</h4>
                        <div class="row">

                            <div class="col-xs-4">
                                <span class="headline credit plus" style="
      background: transparent;
  ">
                                    <strong>1500</strong>
                                </span>
                                <p>USUARIOS</p>
                            </div>
                            <div class="col-xs-4">
                                <span class="headline">
                                    <strong>23</strong>
                                </span>
                                <p>LOCALES</p>
                            </div>
                            <div class="col-xs-4">
                                <span class="headline credit less">
                                    <strong>23</strong>
                                </span>
                                <p>MENSAJES
                                    <small>(Nuevos)</small>
                                </p>
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
                    <a href="users.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-blue"></i>
                                            <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Usuarios</h3>
                                        <p class="help-block">Juez, inspector, etc</p>
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
                    <a href="locals.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-red"></i>
                                            <i class="fa fa-building fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Locales</h3>
                                        <p class="help-block">Alta/Editar</p>
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
                    <a href="special_vehicles.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-cyan"></i>
                                            <i class="fa fa-car fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Vehiculos exceptuados</h3>
                                        <p class="help-block">Alta / Editar</p>
                                    </div>
                                    <!-- /.media -body-->
                                </div>
                                <!-- /.media -->
                            </div>
                            <!-- /.panel-body -->

                            <div class="progress progress-xs no-radius no-margin">
                                <div class="progress-bar bg-grd-cyan" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <!-- /.progress -->
                        </div>
                        <!-- /.panel -->
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="{{ route('blocks.index') }}" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                            <i class="fa fa-map-signs fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Calles</h3>
                                        <p class="help-block">Alta / Editar</p>
                                    </div>
                                    <!-- /.media -body-->
                                </div>
                                <!-- /.media -->
                            </div>
                            <!-- /.panel-body -->

                            <div class="progress progress-xs no-radius no-margin">
                                <div class="progress-bar bg-grd-cyan" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <!-- /.progress -->
                        </div>
                        <!-- /.panel -->
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="areas.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-dark"></i>
                                            <i class="fa fa-map fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Zonas</h3>
                                        <p class="help-block">Alta / Editar</p>
                                    </div>
                                    <!-- /.media -body-->
                                </div>
                                <!-- /.media -->
                            </div>
                            <!-- /.panel-body -->

                            <div class="progress progress-xs no-radius no-margin">
                                <div class="progress-bar bg-grd-cyan" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only"></span>
                                </div>
                            </div>
                            <!-- /.progress -->
                        </div>
                        <!-- /.panel -->
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="spaces.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-orange"></i>
                                            <i class="fa fa-map-pin fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Reserva de espacios</h3>
                                        <p class="help-block">Containers / carga / descarga</p>
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
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="real_time_data.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-info"></i>
                                            <i class="fa fa-location-arrow fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Monitoreo</h3>
                                        <p class="help-block">Ocupación, seguimiento</p>
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
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="informs.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-success"></i>
                                            <i class="fa fa-bar-chart fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Informes</h3>
                                        <p class="help-block">Alta / Editar</p>
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
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a href="messages.html" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                            <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Mensajes</h3>
                                        <p class="help-block">Responder</p>
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
