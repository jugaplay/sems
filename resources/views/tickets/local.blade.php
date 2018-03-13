@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">VENDER TICKETS</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->
        <div class="content-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Datos del estacionamiento</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="ticketFormContainer">
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-date">Patente</label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                        <input type="text" class="form-control input-lg" name="ticketPlate" id="ticketPlate" placeholder="Patente" required="">
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-time">Horas de estacionamiento <small><small> (Fracción mínima, 30 minutos) </small></small></label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon"><i class="fa fa-hourglass-start"></i></span>
                                        <input type="number" class="form-control" value="0" min="0" max="23" step="0.5" name="ticketHours" id="ticketHours">
                                        <span class="input-group-btn">
                                          <a rel="tooltip" data-container="body" title="Elegir estadia" onclick="setToDayTicket()" class="btn">
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                          </a>
                                        </span>
                                    </div>
                                    <!--/input-group-in-->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-time">Hora de salida <small><small> (Máximo 23 horas) </small></small></label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon"><i class="icon-clock"></i></span>
                                        <input type="time" class="form-control" value="" name="ticketTime" id="ticketTime">
                                        <input type="hidden" value="false" name="ticketDay" id="ticketDay">
                                    </div>
                                    <!--/input-group-in-->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <label for="sel1">Tipo de pago:</label>
                                    <select class="form-control" name="ticketPayment" id="ticketPayment">
                                        <option value="EF">Efectivo</option>
                                        <option value="ON">Online</option>
                                    </select>
                                </div>
                                <!--/form-group-->
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    {{csrf_field()}}
                                    <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary btn-lg">
                                      Comprar
                                    </button>
                                </div>

                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-datetime">Costo</label>
                                    <div class="input-group input-group-in cost" id="ticket-cost">
                                        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                        <input type="text" class="form-control input-lg" value="0" disabled="disabled">
                                        <span class="input-group-btn">
                                          <a rel="tooltip" data-container="body" title="Puede realizar la accion" class="btn">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                          </a>
                                        </span>
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->
                            </form>
                            <!--/form-->
                        </div>
                        <!-- /panel-body -->
                    </div>
                    <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
                    <input type="hidden" id="price-time" value="{{ $priceTime }}" />
                    <input type="hidden" id="price-day" value="{{ $priceDay }}" />
                    <input type="hidden" id="wallet-balance" value="{{Auth::user()->wallet->balance}}" />
                    <input type="hidden" id="wallet-credit" value="{{Auth::user()->wallet->credit}}" />
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
<!-- COMPONENTS -->
  <script src="scripts/sems/tickets.js"></script>
@endpush
