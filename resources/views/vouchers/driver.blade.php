@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">COMPROBANTES Y MULTAS</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>

        <!-- /.content-hero -->

        <div class="content-body">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <a href="sell_tickets.html" style="color: inherit;">
                            <div class="panel fade in panel-default" data-init-panel="true">
                                <div class="panel-body">
                                  @if(Auth::user()->infringementsDebt()>0)
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa fa-circle fa-stack-2x text-red"></i>
                                                <i class="fa fa-minus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">Tiene ${{Auth::user()->infringementsDebt()}} en multas</h3>
                                            <p class="help-block">En los vehículos asociados</p>
                                        </div>
                                        <!-- /.media -body-->
                                    </div>
                                    <!-- /.media -->
                                  @else
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa fa-circle fa-stack-2x text-green"></i>
                                                <i class="fa fa fa-check fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </div>
                                        <div class="media-body">
                                            <h3 class="media-heading">No tiene multas</h3>
                                            <p class="help-block">En los vehículos asociados</p>
                                        </div>
                                        <!-- /.media -body-->
                                    </div>
                                  @endif
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
                        <a href="#" id="bootbox-search-voucher" style="color: inherit;">
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
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel fade in panel-danger" data-context="info" data-init-panel="true">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-control pull-right" id="demoBtn">

                                <a href="#" class="btn btn-success btn-nofill">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h3 class="panel-title">
                                <i class="fa fa-minus-circle fa-fw"></i>Multas</h3>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Patente</th>
                                    <th>Estado</th>
                                    <th>Costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->infringements()->take(5) as $infringement)
                                  <tr>
                                    <td>{{ parseDateString($infringement->date)}}</td>
                                    <td>{{ $infringement->cause->name}}</td>
                                    <td>{{ $infringement->plate}}</td>
                                    <td>{{ $infringement->situation}}</td>
                                    <td>{{ $infringement->actualCost()}}</td>
                                  </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="panel fade in panel-info" data-context="info" data-init-panel="true">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-control pull-right" id="demoBtn">

                                <a href="#" class="btn btn-success btn-nofill">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h3 class="panel-title">
                                <i class="fa fa-ticket fa-fw"></i>Tickets</h3>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Patente</th>
                                    <th>Costo</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach (Auth::user()->tickets->take(5) as $ticket)
                                <tr>
                                  <td>{{$ticket->type}}</td>
                                  <td>{{ parseDateString($ticket->start_time)}}</td>
                                  <td>{{ $ticket->plate}}</td>
                                  <td>$ {{ abs($ticket->operation->amount)}}</td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="panel fade in panel-info" data-context="info" data-init-panel="true">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-control pull-right" id="demoBtn">

                                <a href="#" class="btn btn-success btn-nofill">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h3 class="panel-title">
                                <i class="fa fa-money fa-fw"></i>Movimientos</h3>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach (Auth::user()->wallet->operations->take(5) as $operation)
                                <tr>
                                  <td>{{$operation->type}}</td>
                                  <td>{{ parseDateString($operation->created_at)}}</td>
                                  <td>$ {{ $ticket->operation->amount}}</td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <div class="panel fade in panel-info" data-context="info" data-init-panel="true">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <div class="panel-control pull-right" id="demoBtn">

                                <a href="#" class="btn btn-success btn-nofill">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h3 class="panel-title">
                                <i class="fa fa-pencil-square-o fa-fw"></i>Facturas</h3>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Detalle</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach (Auth::user()->wallet->operations->take(5) as $operation)
                                <tr>
                                  <td>{{$operation->bill->detail}}</td>
                                  <td>{{ parseDateString($operation->bill->date)}}</td>
                                  <td>$ {{ $ticket->operation->bill->total}}</td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
@endsection

@push('scripts')
<!-- COMPONENTS -->

@endpush
