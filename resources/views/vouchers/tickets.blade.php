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
            <!-- /.col-md-6 -->
            <div class="col-md-12">
                <div class="panel fade in panel-info" data-context="info" data-init-panel="true">
                    <div class="panel-heading">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-ticket fa-fw"></i>Tickets</h3>
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
                              @foreach ($tickets as $ticket)
                                <tr>
                                  <td>{{parseTicketType($ticket->type)}}</td>
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
                <div class="col-xs-12 text-center">
                  {{ $tickets->appends(request()->query())->render() }}
                </div>
            </div>

        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
@endsection

@push('scripts')
<!-- COMPONENTS -->

@endpush
