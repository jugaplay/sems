@extends('layouts.app')

@section('content')
<section class="content-wrapper" role="main" data-init-content="true">
    <div class="content">
        <div id="content-hero" class="content-hero">
            <img class="content-hero-embed" src="../images/dummy/people4.jpg" alt="cover">
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
                                <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                    <img alt="avatar" onclick="openPhotoSwipe()" title="username" src="../images/dummy/mal.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                    <img alt="avatar" onclick="openPhotoSwipe()" title="username" src="../images/dummy/mal2.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                    <img alt="avatar" onclick="openPhotoSwipe()" title="username" src="../images/dummy/mal3.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                    <img alt="avatar" onclick="openPhotoSwipe()" title="username" src="../images/dummy/mal.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                    <img alt="avatar" onclick="openPhotoSwipe()" title="username" src="../images/dummy/mal2.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-64 kit-avatar-square mt-2x mb-2x mr-1x" href="#">
                                    <img alt="avatar" onclick="openPhotoSwipe()" title="username" src="../images/dummy/mal3.jpg">
                                </a>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <h2>Comentarios</h2>
                    <div class="timeline-panel panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-body">
                            <div class="media mb-2x">
                                <div class="media-left">
                                    <a href="#" class="timeline-avatar kit-avatar kit-avatar-36">
                                        <img class="media-object" src="../images/dummy/uifaces18.jpg" alt="">
                                    </a>
                                </div>
                                <!-- /.media-left -->
                                <div class="media-body">
                                    <p class="media-heading">
                                        <strong>Angela Fowler</strong>
                                        <br>
                                        <small class="text-muted">30 minutes</small>
                                    </p>
                                </div>
                                <!-- /.media-body -->
                            </div>
                            <!-- /.media -->
                            <p>Assumenda, pariatur repellendus voluptatum eaque sint, quibusdam voluptatem nulla nesciunt placeat sunt tempore ad reiciendis ducimus dicta neque minima debitis delectus ab!</p>
                        </div>
                        <!-- /.panel-body -->

                        <div class="panel-body timeline-resume">
                            <div class="pull-right" data-toggle="tooltip" title="" data-original-title="in this post">
                                <a class="kit-avatar kit-avatar-28 align-middle no-border" href="#">
                                    <img alt="avatar" title="friend name" src="../images/dummy/uifaces16.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-28 align-middle no-border" href="#">
                                    <img alt="avatar" title="friend name" src="../images/dummy/uifaces16.jpg">
                                </a>
                                <a class="kit-avatar kit-avatar-28 align-middle no-border" href="#">
                                    <img alt="avatar" title="friend name" src="../images/dummy/uifaces18.jpg">
                                </a>

                            </div>

                        </div>
                        <!-- /.panel-body -->

                        <div class="panel-body timeline-livelines">
                            <div class="media">
                                <div class="media-left">
                                    <a class="kit-avatar kit-avatar-32" href="#">
                                        <img class="media-object" src="../images/dummy/uifaces16.jpg">
                                    </a>
                                </div>
                                <div class="media-body bordered-bottom">
                                    <p class="media-heading">
                                        <strong>Arina Rosetti</strong> Consequuntur illo accusantium, expedita ratione dolorem fuga minima!</p>
                                    <p class="text-muted">
                                        <small>22 minutes</small>
                                    </p>
                                </div>
                            </div>

                            <!-- /.media -->
                            <div class="media">
                                <div class="media-left">
                                    <a class="kit-avatar kit-avatar-32" href="#">
                                        <img class="media-object" src="../images/dummy/uifaces16.jpg">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <strong>Felix Koller</strong> Molestias ipsum hic voluptas soluta expedita, ab, dolorum aperiam neque nesciunt.</p>
                                    <p class="text-muted">
                                        <small>10 minutes</small>
                                    </p>
                                </div>
                            </div>
                            <!-- /.media -->
                        </div>
                        <!-- /.panel-body -->

                        <div class="panel-footer timeline-livelines">
                            <form action="#">
                                <a class="kit-avatar kit-avatar-28 no-border pull-left" href="#">
                                    <img class="media-object" src="../images/dummy/uifaces16.jpg">
                                </a>
                                <div class="input-group input-group-in no-border">
                                    <input class="form-control" placeholder="write comment...">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn">
                                            <i class="fa fa-chevron-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-8 col-sm-12">
                    <h2>Datos</h2>
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              <i class="fa fa-user fa-fw" aria-hidden="true"></i> Datos del dueño</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Nombre</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-user"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="Juan Martinez" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Nacimiento</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa fa-calendar"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="23/05/1985" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">DNI:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-file"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="28135685" disabled="disabled">
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
                                    <input type="text" class="form-control input-lg" value="Luis Costa 150" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                        </div>
                        <!-- /panel-body -->
                    </div>
                    <!-- /panel fade in panel-default panel-fill -->
                    <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              <i class="fa fa-warning fa-fw" aria-hidden="true"></i> Datos de la infracción</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Patente</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-car"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="MMD 879" disabled="disabled">
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
                                    <input type="text" class="form-control input-lg" value="15/01/18 - 3:35 PM" disabled="disabled">
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
                                    <input type="text" class="form-control input-lg" value="Luis Costa 150" disabled="disabled">
                                    <span class="input-group-btn">
                                      <a rel="tooltip" data-container="body" title="" onclick="showInMap()" class="btn" data-original-title="Ver en mapa">
                                          <i class="fa fa fa-map-o" aria-hidden="true"></i>
                                      </a>
                                  </span>
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Infraccion:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-file"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="Mal estacionado" disabled="disabled">
                                    <span class="input-group-btn">
                                      <a rel="tooltip" data-container="body" title="" onclick="showInfringementDetail()" class="btn" data-original-title="Ver datos de la infración">
                                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                                      </a>
                                  </span>
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Costo:</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="1200" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                            <div class="form-group form-group-lg">
                                <label class="control-label" for="mask-date">Costo voluntario: (02/02/18)</label>
                                <div class="input-group input-group-in">
                                    <span class="input-group-addon">
                                      <i class="fa fa-usd"></i>
                                  </span>
                                    <input type="text" class="form-control input-lg" value="600" disabled="disabled">
                                </div>
                                <!-- /input-group-in -->
                            </div>
                            <!--/form-group-->
                        </div>
                        <!-- /panel-body -->
                    </div>
                    <!-- /panel fade in panel-default panel-fill -->

                    <!-- /.panel-footer -->

                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="btn-divider mr-2x mb-1x" role="divider">
                        <button type="button" class="btn btn-lg btn-default" onclick="dontChargeInfraction()">Perdonar</button>
                        <span class="label-divider">o</span>
                        <button type="button" class="btn btn-lg btn-success" onclick="chargeInfraction()">Cobrar</button>
                    </div>
                </div>
            </div>
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
@endpush
