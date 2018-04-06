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
                                    <img alt="cover" src="images/dummy/uifaces20.jpg">
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <a href="{{ route('login') }}">
                                    <div class="visible-xs">
                                        <h2 class="display-name media-heading text-teal">Anonimo</h2>
                                        <p class="text-muted mb-4x">
                                            <i class="fa fa fa-sign-in fa-fw"></i> Ingresar</p>
                                    </div>
                                    <div class="hidden-xs">
                                        <h2 class="media-heading text-light">Anonimo</h2>
                                        <p class="mb-4x text-light">
                                            <span>
                                                <i class="fa fa fa-sign-in fa-fw"></i> Ingresar</span>
                                        </p>
                                    </div>
                                </a>
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
                                <span class="headline credit less" style="background: transparent;">
                                    <strong>$ ....</strong>
                                </span>
                                <p>SALDO</p>
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
                    <a href="javascript:openBuyTickets()" style="color: inherit;">
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
                                        <h3 class="media-heading">Comprar tickets</h3>
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
                    <a href="#" id="bootbox-search-voucher" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-violet"></i>
                                            <i class="fa fa fa-search fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Buscar comprobantes</h3>
                                        <p class="help-block">Busque facturas por codigo</p>
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
                    <a href="#" id="bootbox-search-infraction" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-grey"></i>
                                            <i class="fa fa fa-search fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Buscar multas</h3>
                                        <p class="help-block">Verifique un dominio</p>
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
                    <a href="{{ route('login') }}" style="color: inherit;">
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-circle fa-stack-2x text-cyan"></i>
                                            <i class="fa fa-sign-in fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading">Ingresar</h3>
                                        <p class="help-block">Ingresar o registrarse</p>
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
                <!-- /.cols -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
@push('scripts')
<!-- COMPONENTS -->
<script src="{{URL::to('/scripts/sems/search-vouchers-infractions.js')}}"></script>
@endpush
