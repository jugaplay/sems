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
                                    <img alt="cover" src="images/dummy/uifaces16.jpg">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="visible-xs">
                                    <h2 class="display-name media-heading text-teal">{{Auth::user()->name}}</h2>
                                    <p class="text-muted mb-4x">
                                        <i class="fa fa fa-balance-scale fa-fw"></i> Juez</span>
                                    </p>
                                </div>
                                <div class="hidden-xs">
                                    <h2 class="media-heading text-light">{{Auth::user()->name}}</h2>
                                    <p class="mb-4x text-light">
                                        <span>
                                            <i class="fa fa fa-balance-scale fa-fw"></i> Juez</span>
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
                    <a href="{{ route('infringements.index') }}" id="bootbox-search-voucher" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-violet"></i>
                                            <i class="fa fa fa-search
fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Buscar infracciones</h3>
                                        <p class="help-block">Cobrar, cancelar y más</p>
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
                    <a href="http://www.dnrpa.gov.ar/portal_dnrpa/radicacion.php.html" target="_blank" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-cyan"></i>
                                            <i class="fa fa-car
fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Radicación del vehículo</h3>
                                        <p class="help-block">Ministerio de justicia</p>
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
                    <a href="https://www.arba.gov.ar/DominiosRetenidos/DominiosRetenidos.asp" target="_blank" id="bootbox-search-voucher" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-grey"></i>
                                            <i class="fa fa-cloud-upload
fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Captura</h3>
                                        <p class="help-block">Ver, subir pedidos de captura</p>
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
                <!-- /.cols -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
