@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">VENDER CREDITO</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>
        <!-- /.content-hero -->

        <div class="content-body">

            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-xs-12">
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-money fa-fw" aria-hidden="true"></i> Vender credito</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="creditFormContainer">
                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-date">Usuario</label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control input-lg" name="creditMail" id="creditMail" placeholder="@mail" required="">
                                        <span class="input-group-btn">
                                        <button rel="tooltip" data-container="body" data-loading-text="<i class='fa fa-spinner fa-spin'></i>" title="Confirmar datos del usuario" id="checkUsersData" class="btn">
                                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </button>
                                      </span>
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->

                                <div class="form-group form-group-lg">
                                    <label class="control-label" for="mask-datetime">Dinero a transferir</label>
                                    <div class="input-group input-group-in">
                                        <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                        <input type="text" class="form-control input-lg" name="creditAmount" id="creditAmount" placeholder="200" required="">
                                    </div>
                                    <!-- /input-group-in -->
                                </div>
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                    <label for="sel1">Tipo de pago:</label>
                                    <select class="form-control" name="creditPayment" id="creditPayment">
                                      <option value="EF">Efectivo</option>
                                      <option value="ON">Online</option>
                                    </select>
                                </div>
                                <!--/form-group-->
                                <!--/form-group-->
                                <div class="form-group form-group-lg">
                                  <input type="hidden" name="creditType" id="creditType" value="sell" >
                                  {{csrf_field()}}
                                  <button type="submit" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Procesando" class="btn btn-primary btn-lg">
                                    Enviar
                                  </button>
                                </div>
                            </form>
                            <!--/form-->
                        </div>
                        <!-- /panel-body -->
                        <input type="hidden" id="wallet-balance" value="{{Auth::user()->wallet->balance}}" />
                        <input type="hidden" id="wallet-credit" value="{{Auth::user()->wallet->credit}}" />
                    </div>
                    <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->

                </div>
                <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
<script type="text/javascript">
    window.ajax_token = '{{ csrf_token() }}';
</script>
@endsection

@push('scripts')
<!-- COMPONENTS -->
  <script src="scripts/sems/credits.js"></script>
@endpush
