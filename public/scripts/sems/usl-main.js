/* Usuarios sin login */
(function(){
  'use strict';

  var bootbox = window.bootbox,
  toastr = window.toastr;

  toastr.options = {
    positionClass: 'toast-top-right',
    progressBar: true
  };
  var TEMPLATE_PANEL_SEARCH_VOUCHER=''
  +'<div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
  +'              <div class="panel-body">'
  +'                <form role="form">'
  +'                  <div class="form-group form-group-lg">'
  +'                    <label class="control-label" for="mask-date">Patente</label>'
  +'                    <div class="input-group input-group-in">'
  +'                      <span class="input-group-addon"><i class="fa fa-car"></i></span>'
  +'                      <input type="text" class="form-control input-lg" id="inputPass" placeholder="Patente">'
  +'                    </div><!-- /input-group-in -->'
  +'                  </div><!--/form-group-->'
  +'                  <div class="form-group form-group-lg">'
  +'                    <label class="control-label" for="mask-date">Codigo</label>'
  +'                    <div class="input-group input-group-in">'
  +'                      <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>'
  +'                      <input type="text" class="form-control input-lg" id="inputPass" placeholder="Codigo">'
  +'                    </div><!-- /input-group-in -->'
  +'                  </div><!--/form-group-->   '
  +'                </form><!--/form-->'
  +'              </div><!-- /panel-body -->'
  +'            </div>';
  $( '#bootbox-search-voucher' ).on( 'click', function(){
    bootbox.dialog({
      message: TEMPLATE_PANEL_SEARCH_VOUCHER,
      title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Datos del estacionamiento',
      buttons: {
        danger: {
          label: 'Mostrar error',
          className: 'btn-danger',
          callback: function() {
            toastr.error('No se encontro el comprobante');
          }
        },
        success: {
          label: 'Buscar',
          className: 'btn-success',
          callback: function() {
            mostrarComprobante();
          }
        }
      }
    });
  });
})(window);
function mostrarComprobante(){
  var VOUCHER_TEMPLATE=''
+'            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
+'              <div class="panel-body big-bootbox">'
+'                <form role="form">'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Patente</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-car"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control input-lg" id="inputPass" value="AB-123-CD" disabled="disabled"> </div>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                    <!--/form-group-->'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Codigo</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-qrcode"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control input-lg" id="inputPass" value="vgh7685" disabled="disabled"> </div>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                    <!--/form-group-->'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-time">Lugar</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-map-marker"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control" value="Luis Costa 150" id="example-time-input" disabled="disabled">'
+'                          </div>'
+'                          <!--/input-group-in-->'
+'                      </div>'
+'                      <!--/form-group-->'
+'                      <div class="form-group form-group-lg">'
+'                          <label class="control-label" for="mask-time">Inicio</label>'
+'                          <div class="input-group input-group-in">'
+'                              <span class="input-group-addon">'
+'                                  <i class="icon-clock"></i>'
+'                              </span>'
+'                              <input type="text" class="form-control" value="11/01/2018 11:11 AM" id="example-time-input" disabled="disabled">'
+'                          </div>'
+'                          <!--/input-group-in-->'
+'                      </div>'
+'                      <!--/form-group-->'
+'                      <div class="form-group form-group-lg">'
+'                          <label class="control-label" for="mask-time">Fin</label>'
+'                          <div class="input-group input-group-in">'
+'                              <span class="input-group-addon">'
+'                                  <i class="icon-clock"></i>'
+'                              </span>'
+'                              <input type="text" class="form-control" value="11/01/2018 2:11 PM" id="example-time-input" disabled="disabled">'
+'                          </div>'
+'                          <!--/input-group-in-->'
+'                      </div>'
+'                      <!--/form-group-->'
+'                      <div class="form-group form-group-lg">'
+'                          <label class="control-label" for="mask-datetime">Costo</label>'
+'                          <div class="input-group input-group-in">'
+'                              <span class="input-group-addon">'
+'                                  <i class="fa fa-usd"></i>'
+'                              </span>'
+'                              <input type="text" class="form-control input-lg" id="inputPass" value="400,25" disabled="disabled">'
+'                          </div>'
+'                          <!-- /input-group-in -->'
+'                      </div>'
+'                      <!--/form-group-->'
+'                  </form>'
+'              </div><!-- /panel-body -->'
+'            </div>';
  bootbox.dialog({
    message: VOUCHER_TEMPLATE,
    title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Comprobante',
    buttons: {
      success: {
        label: 'Abrir factura electronica',
        className: 'btn-success',
        callback: function() {
          window.open('https://drive.google.com/file/d/0BwSn8tJK-kjlQ2xqOEM4ZHdSSExPYzVoR1ZheHR0dDZZdGZv/view?usp=sharing');
        }
      }
    }
  });
}
