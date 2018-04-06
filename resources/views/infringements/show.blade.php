@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="{{URL::to('images/dummy/people4.jpg')}}" alt="cover">
            <div class="content-hero-overlay bg-grd-blue"></div>
            <div class="content-hero-body">
                <!-- /.content-bar -->
                <h1 style="color: white;">INFRACCION</h1>
            </div>
            <!-- /.content-hero-body -->
        </div>

        <!-- /.content-hero -->

        <div class="content-body">
            <div class="row">
                <div class="col-lg-4 col-sm-12 pull-right">
                    <h2>Fotos</h2>
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-body">
                            <div class="text-center">
                              @foreach ($infringement->images as $image)
                                  <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                      <img onclick="openPhotoSwipe('{{ $image->publicUrl() }}')" name="kit-avatar-gallery" src="{{ $image->publicUrl() }}">
                                  </a>
                              @endforeach
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <h2>Comentarios</h2>
                    <div class="timeline-panel panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        @foreach ($infringement->details as $detail)
                            @if ($loop->first)
                              <div class="panel-body">
                                  <div class="media mb-2x">
                                      <div class="media-left">
                                          <a class="timeline-avatar kit-avatar kit-avatar-36">
                                              <img class="media-object" src="{{URL::to(imgOfTypeOfUser($detail->user->type))}}" alt="">
                                          </a>
                                      </div>
                                      <!-- /.media-left -->
                                      <div class="media-body">
                                          <p class="media-heading">
                                              <strong>{{$detail->user->name}}</strong>
                                              <br>
                                              <small class="text-muted">{{parseDateTimeString($detail->created_at)}}</small>
                                          </p>
                                      </div>
                                      <!-- /.media-body -->
                                  </div>
                                  <!-- /.media -->
                                  <p>{{$detail->detail}}</p>
                              </div>
                              <div class="panel-body timeline-livelines" id="comments-of-users">
                            @else
                              <div class="media">
                                  <div class="media-left">
                                      <a class="kit-avatar kit-avatar-32" href="#">
                                          <img class="media-object" src="{{URL::to(imgOfTypeOfUser($detail->user->type))}}">
                                      </a>
                                  </div>
                                  <div class="media-body bordered-bottom">
                                      <p class="media-heading">
                                          <strong>{{$detail->user->name}}</strong> {{$detail->detail}}</p>
                                      <p class="text-muted">
                                          <small>{{parseDateTimeString($detail->created_at)}}</small>
                                      </p>
                                  </div>
                              </div>
                            @endif
                          @endforeach
                        <!-- /.panel-body -->
                        </div>
                        <!-- /.panel-body -->
                        @if(Auth::user()->type!="driver")
                        <div class="panel-footer timeline-livelines">
                            <form action="POST" id="addCommentForm" url="/infringements/comments">
                                <a class="kit-avatar kit-avatar-28 no-border pull-left" href="#">
                                    <img class="media-object" src="{{URL::to(imgOfTypeOfUser(Auth::user()->type))}}">
                                </a>
                                <div class="input-group input-group-in no-border">
                                    <input  type="hidden" name="infringementId" value="{{$infringement->id}}" >
                                    <input class="form-control" id="infringementComment" name="infringementComment" placeholder="Escribir un comentario ...">
                                    {{csrf_field()}}
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn" data-loading-text="<i class='fa fa-spinner fa-spin'></i>">
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-8 col-sm-12">
                    <h2>Datos</h2>
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        @if(is_null($infringement->vehicle->owner))
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              <i class="fa fa-user fa-fw" aria-hidden="true"></i> No se encontraron datos del dueño del vehículo </h3>
                        </div>
                        @else
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              <i class="fa fa-user fa-fw" aria-hidden="true"></i> Datos del dueño del vehículo</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Nombre</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-user"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->vehicle->owner->name}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">{{$infringement->vehicle->owner->document_type}}:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-file"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->vehicle->owner->document_number}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Domicilio:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-map-marker"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->vehicle->owner->address}}, {{$infringement->vehicle->owner->city}}, {{$infringement->vehicle->owner->state}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                        </div>
                        @endif
                        <!-- /panel-body -->
                    </div>
                    <!-- /panel fade in panel-default panel-fill -->
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              <i class="fa fa-warning fa-fw" aria-hidden="true"></i> Datos de la infracción</h3>
                              <input  type="hidden" name="infringementId" id="infringementId" value="{{$infringement->id}}" >
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Patente</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-car"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->plate}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Fecha</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa fa-calendar"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{parseDateString($infringement->date)}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Dirección:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-map-marker"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->block->street}} {{$infringement->block->numeration_min}} - {{$infringement->block->numeration_max}}" disabled="disabled">
                                    <span class="input-group-btn">
                                      <a rel="tooltip" data-container="body" title="" onclick="showPointInMap({{json_decode($infringement->latlng)[0]}},{{json_decode($infringement->latlng)[1]}})" class="btn" data-original-title="Ver en mapa">
                                          <i class="fa fa fa-map-o" aria-hidden="true"></i>
                                      </a>
                                  </span>
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Infracción:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-file"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->cause->name}}" disabled="disabled">
                                    <span class="input-group-btn">
                                      <a rel="tooltip" data-container="body" title="" onclick="simpleAlert('{{$infringement->cause->name}}','{{$infringement->cause->detail}}')" class="btn" data-original-title="Ver datos de la infración">
                                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                                      </a>
                                  </span>
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            @if($infringement->situation!="close")
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Costo:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->cost}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Costo voluntario: ({{parseDateString($infringement->voluntary_end_date)}})</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{$infringement->voluntary_cost}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            @else
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Costo pagado:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                  </span>
                                    @if($infringement->close_cost!=0)
                                      <input type="text" class="form-control input-lg" value="{{$infringement->close_cost}}" disabled="disabled">
                                    @else
                                      <input type="text" class="form-control input-lg" value="Perdonada" disabled="disabled">
                                    @endif
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Fecha de cierre:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="{{parseDateString($infringement->close_date)}}" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            @endif
                            <!--/form-group-->
                        </div>
                        <!-- /panel-body -->
                    </div>
                    <!-- /panel fade in panel-default panel-fill -->

                    <!-- /.panel-footer -->

                </div>
            </div>
            <!-- /.row -->
            @if($infringement->situation!="close" && Auth::user()->type!="driver")
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="btn-divider mr-2x mb-1x" role="divider">
                        <button type="button" class="btn btn-lg btn-default" onclick="dontChargeInfraction()">Perdonar</button>
                        <span class="label-divider">o</span>
                        <button type="button" class="btn btn-lg btn-success" onclick="chargeInfraction({'voluntary_cost':{{$infringement->voluntary_cost}},'voluntary_end_date':'{{$infringement->voluntary_end_date}}','cost':'{{$infringement->cost}}'})">Cobrar</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- /.content-body -->
    </div>
    <!-- /.content -->
</section>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Cerrar (Esc)"></button>


                <button class="pswp__button pswp__button--fs" title="Pantalla completa"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom"></button>


                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>


            <button class="pswp__button pswp__button--arrow--left" title="Anterior (flecha izquierda)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Siguiente (flecha derecha)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="{{URL::to('scripts/photoswipe.pkgd.js')}}"></script>
<!-- END COMPONENTS -->
<script src="{{URL::to('scripts/sems/judge-infraction.js')}}"></script>
<link rel="stylesheet" href="{{URL::to('styles/leaflet.css')}}">
<script src="{{URL::to('scripts/sems/leaflet.js')}}"></script>
<script src="{{URL::to('scripts/sems/points-in-maps.js')}}"></script>
@endpush
