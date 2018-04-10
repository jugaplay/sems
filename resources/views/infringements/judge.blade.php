@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="{{URL::to('images/dummy/people4.jpg')}}" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">INFRACCIONES</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->
        <div class="content-body">
            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                <div class="panel-heading">
                  <form id="judgeSearchForm" action="{{ route('infringements.filter') }}"  method="GET">
                    <div class="row">
                        <!-- /.cols -->
                        <div class="col-xs-12 text-right">
                            <div class="form-group">
                                <button id="reportrange" data-drops="up" class="btn btn-block btn-default btn-lg">
                                    <i class="fa fa-calendar fa-fw"></i> <span>Seleccionar fechas para filtrar</span>
                                </button>
                                <input type="hidden" id="infringementStarts" name="infringementStarts" value="@if(isset($_GET['infringementStarts'])){{$_GET['infringementStarts']}}@endif">
                                <input type="hidden" id="infringementEnds" name="infringementEnds" value="@if(isset($_GET['infringementEnds'])){{$_GET['infringementEnds']}}@endif">
                            </div>
                        </div>
                        <!-- /.cols -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="input-group input-group-in no-bg no-border">
                                <div class="input-group-addon no-padding pr-2x"><i class="icon-magnifier"></i></div>
                                <input class="form-control no-padding" id="infringementText" onkeydown="parseSearchInput(this)" name="infringementText" value="@if(isset($_GET['infringementText'])) {{$_GET['infringementText']}} @endif" placeholder="Ingrese patente o DNI">
                            </div>
                        </div>
                        <!-- /.cols -->
                        <div class="col-sm-8 form-group text-right">
                            <p class="help-inline form-control-static mr-2x hidden-xs">Filtro: </p>
                            <label class="select select-sm mr-3x" style="display:inline-block;width:100px">
                                <select id="infringementFilter" name="infringementFilter">
                                    <option value="">Ninguno</option>
                                    <option value="Dominio" @if(isset($_GET['infringementFilter']))@if($_GET['infringementFilter']=="Dominio") selected @endif @endif>Dominio</option>
                                    <option value="Dni" @if(isset($_GET['infringementFilter']))@if($_GET['infringementFilter']=="Dni") selected @endif @endif>Dni</option>
                                </select>
                            </label>
                            <p class="help-inline form-control-static mr-2x hidden-xs">Type: </p>
                            <label class="select select-sm" style="display:inline-block;width:120px">
                                <select id="infringementType" name="infringementType">
                                    <option value="">Todos</option>
                                    <option value="open" @if(isset($_GET['infringementType']))@if($_GET['infringementType']=="open") selected @endif @endif>Abiertas</option>
                                    <option value="voluntary" @if(isset($_GET['infringementType']))@if($_GET['infringementType']=="voluntary") selected @endif @endif>Pago voluntario</option>
                                    <option value="saved" @if(isset($_GET['infringementType']))@if($_GET['infringementType']=="saved") selected @endif @endif>Vencidas</option>
                                    <option value="close" @if(isset($_GET['infringementType']))@if($_GET['infringementType']=="close") selected @endif @endif>Cerradas</option>
                                </select>
                            </label>
                        </div>
                        <!-- /.cols -->
                    </div>
                    <div class="row">
                        <!-- /.cols -->
                        <div class="col-xs-12 text-right">
                            <div class="form-group form-group-lg">
                                {{csrf_field()}}
                                <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary btn-lg">
                                  Buscar
                                </button>
                            </div>
                        </div>
                        <!-- /.cols -->
                    </div>
                  </form>
                </div>
                <!-- /.panel-heading -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h2><i>{{ $infringements->total() }} </i>Resultados</i></h2>
                    <h3><i>Pagina <i>{{ $infringements->currentPage() }} de {{ $infringements->lastPage() }}</i></h3>
                    @foreach ($infringements as $infringement)
                        <div class="panel fade in panel-default" data-init-panel="true">
                            <div class="panel-body">
                                <div class="search-result-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a class="kit-avatar kit-avatar-128 kit-avatar-square" href="{{ route('infringements.index') }}/{{ $infringement->id }}">
                                                <img class="media-object" src="{{ $infringement->img() }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="pull-right">
                                              @switch($infringement->situation)
                                                  @case("saved")
                                                      <span class="label label-warning">Vencida</span>
                                                      @break
                                                  @case("voluntary")
                                                      <span class="label label-primary">Pago voluntario</span>
                                                      @break
                                                  @case("close")
                                                      <span class="label label-default">Cerrada</span>
                                                      @break
                                                  @default
                                                      <!-- Un estado no contemplado, ojo con el estado judge -->
                                              @endswitch
                                            </div>
                                            <p class="media-heading"><a href="{{ route('infringements.index') }}/{{ $infringement->id }}">{{ $infringement->plate }} -- {{ $infringement->cause->name }}</a></p>
                                            <p class="text-muted"><small>{{ parseDateString($infringement->date) }} <b>Costo: ${{ $infringement->cost }}</b></small></p>
                                              <p><b>Detalle:</b> {{ $infringement->details->first()->detail }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.search-result-item -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    @endforeach
                    <!-- /.panel -->
                    <!-- /.panel -->
                    <div class="col-xs-12 text-center">
                      {{ $infringements->appends(request()->query())->render() }}
                    </div>
                </div>
                <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
@endsection

@push('scripts')
<link rel="stylesheet" href="{{URL::to('styles/components.css')}}">
<script src="{{URL::to('scripts/moment.js')}}"></script>
<script src="{{URL::to('scripts/daterangepicker.js')}}"></script>
<!-- END COMPONENTS -->
<script src="{{URL::to('scripts/sems/judge-infractions.js')}}"></script>
@endpush
