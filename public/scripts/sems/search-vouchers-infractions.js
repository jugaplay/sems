/* Usuarios sin login */
// bootbox-search-infraction
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
  +'                      <input type="text" onkeydown="upperCaseF(this)" class="form-control input-lg" id="searchVoucherPlate" placeholder="Patente">'
  +'                    </div><!-- /input-group-in -->'
  +'                  </div><!--/form-group-->'
  +'                  <div class="form-group form-group-lg">'
  +'                    <label class="control-label" for="mask-date">Codigo</label>'
  +'                    <div class="input-group input-group-in">'
  +'                      <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>'
  +'                      <input type="text" class="form-control input-lg" id="searchVoucherCode" placeholder="Codigo">'
  +'                    </div><!-- /input-group-in -->'
  +'                  </div><!--/form-group-->   '
  +'                </form><!--/form-->'
  +'              </div><!-- /panel-body -->'
  +'            </div>';
  var TEMPLATE_PANEL_SEARCH_INFRACTION=''
  +'<div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
  +'              <div class="panel-body">'
  +'                <form role="form">'
  +'                      <div class="row">'
  +'                          <div class="col-sm-6">'
  +'                              <div class="input-group input-group-in no-bg no-border">'
  +'                                  <div class="input-group-addon no-padding pr-2x"><i class="icon-magnifier"></i></div>'
  +'                                  <input class="form-control no-padding"  onkeydown="upperCaseF(this)" id="searchInfringementText" name="infringementText" value="" placeholder="Ingresar datos">'
  +'                              </div>'
  +'                          </div>'
  +'                          <!-- /.cols -->'
  +'                          <div class="col-sm-6 form-group text-right">'
  +'                              <p class="help-inline form-control-static mr-2x hidden-xs">Filtro: </p>'
  +'                              <label class="select select-sm mr-3x" style="display:inline-block;width:100px">'
  +'                                  <select id="searchInfringementFilter" name="searchInfringementFilter">'
  +'                                      <option value="Dominio">Patente</option>'
  +'                                      <option value="Dni">Dni</option>'
  +'                                  </select>'
  +'                              </label>'
  +'                          </div>'
  +'                          <!-- /.cols -->'
  +'                      </div>'
  +'                </form><!--/form-->'
  +'              </div><!-- /panel-body -->'
  +'            </div>';
  // toastr.error('No se encontro el comprobante');
  $( '#bootbox-search-infraction' ).on( 'click', function(){
    bootbox.dialog({
      message: TEMPLATE_PANEL_SEARCH_INFRACTION,
      title: '<i class="fa fa-minus-circle fa-fw" aria-hidden="true"></i> Buscar multas',
      buttons: {
        success: {
          label: 'Buscar',
          className: 'btn-success',
          callback: function() {
            if($("#searchInfringementText").val().length<3){
              simpleAlert("Ingrese un código","Es necesario ingresar un código para realizar la búsqueda.");
              return false;
            }
            searchForInfrigements($("#searchInfringementText").val(),$("#searchInfringementFilter").val());
          }
        }
      }
    });
  });
  function searchForInfrigements(text,filter){
    toastr.success( 'Cargando...' );
    text=text.replace(/[^a-zA-Z0-9]/g, '');
    console.log(text);
    var datas = JSON.stringify({"text":text,"filter":filter});
    var jqxhr = $.ajax({
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': window.ajax_token
                    },
                    url: window.apiUrl+"vouchers/infringements/search",
                    dataType: "json",
                    data: datas
                  })
                  .done(function(xhr) {
                    console.log(JSON.stringify(xhr));
                    if(xhr.length>0){
                      showInfrigementsPop(xhr);
                    }else{
                      simpleAlert("Sin multas","No se encontraron multas para "+filter+" = <b>"+text+"</b>");
                    }
                  })
                  .fail(function(xhr) {
                    if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                    else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                    else{
                      toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                   }
                 });
  }
  $( '#bootbox-search-voucher' ).on( 'click', function(){
    bootbox.dialog({
      message: TEMPLATE_PANEL_SEARCH_VOUCHER,
      title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Datos del estacionamiento',
      buttons: {
        success: {
          label: 'Buscar',
          className: 'btn-success',
          callback: function() {
            if(!preVerifiedPlate($("#searchVoucherPlate").val())){
              return false;
            }
            if($("#searchVoucherCode").val().length<3){
              simpleAlert("Ingrese un código","Es necesario ingresar un código para realizar la búsqueda.");
              return false;
            }
            searchForVoucher($("#searchVoucherPlate").val(),$("#searchVoucherCode").val());
          }
        }
      }
    });
  });
})(window);
function searchForVoucher(plate,code){
  toastr.success( 'Cargando...' );
  var datas = JSON.stringify({"plate":plate,"code":code});
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"vouchers/tickets/search",
                  dataType: "json",
                  data: datas
                })
                .done(function(xhr) {
                  showVoucher(xhr);
                  console.log(JSON.stringify(xhr));
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{
                    toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                 }
               });
}
function showVoucher(data){
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
+'                            <input type="text" class="form-control input-lg" value="{PLATE}" disabled="disabled"> </div>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                    <!--/form-group-->'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Codigo</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-qrcode"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control input-lg" value="{CODE}" disabled="disabled"> </div>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                    <!--/form-group-->'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-time">Lugar</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-map-marker"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control" value="{STREET}" disabled="disabled">'
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
+'                              <input type="text" class="form-control" value="{START}" disabled="disabled">'
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
+'                              <input type="text" class="form-control" value="11/01/2018 2:11 PM" disabled="disabled">'
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
+'                              <input type="text" class="form-control input-lg" value="400,25" disabled="disabled">'
+'                          </div>'
+'                          <!-- /input-group-in -->'
+'                      </div>'
+'                      <!--/form-group-->'
+'                  </form>'
+'              </div><!-- /panel-body -->'
+'            </div>';
  var props={
    "{PLATE}":data.plate,
    "{CODE}":data.code,
    "{STREET}":data.street,
    "{START}":parseSqlDate(data.start),
    "{END}":parseSqlDate(data.end),
    "{COST}":data.cost
  }
  bootbox.dialog({
    message: parseTemplate(props,VOUCHER_TEMPLATE),
    title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Comprobante',
    buttons: {
      success: {
        label: 'Abrir factura electronica',
        className: 'btn-success',
        callback: function() {
          window.open(window.baseUrl.substring(0, -1)+data.bill);
        }
      }
    }
  });
}
function showInfrigementsPop(infrigements){
  var INFRIGEMENT_TEMPLATE=''
  +' <div class="panel fade in panel-default" data-init-panel="true">'
  +'       <div class="panel-body">'
  +'           <div class="search-result-item">'
  +'               <div class="media">'
  +'                   <div class="media-left">'
  +'                       <a class="kit-avatar kit-avatar-128 kit-avatar-square" href="{URL}/{ID}?token={TOKEN}">'
  +'                           <img class="media-object" src="{IMG}">'
  +'                       </a>'
  +'                   </div>'
  +'                   <div class="media-body">'
  +'                       <div class="pull-right">'
  +'                           {LABEL}'
  +'                       </div>'
  +'                       <p class="media-heading"><a href="{URL}/{ID}?token={TOKEN}">{PLATE} -- {TYPE}</a></p>'
  +'                       <p class="text-muted"><small>{DATE} <b>Costo: ${COST}</b></small></p>'
  +'                       <p><b>Detalle:</b> {DETAIL}</p>'
  +'                   </div>'
  +'               </div>'
  +'           </div>'
  +'           <!-- /.search-result-item -->'
  +'       </div>'
  +'       <!-- /.panel-body -->'
  +'   </div>'
  +'   <!-- /.panel -->';
  var parseInfrigements='';
  for (inf in infrigements){
    var props={
      "{URL}":window.baseUrl+"vouchers/infringements",
      "{ID}":infrigements[inf].id,
      "{TOKEN}":infrigements[inf].hash,
      "{IMG}":window.baseUrl.substring(0, -1)+infrigements[inf].img,
      "{LABEL}":parseLabelInfrigement(infrigements[inf].estado),
      "{PLATE}":infrigements[inf].plate,
      "{TYPE}":infrigements[inf].tipo,
      "{DATE}":parseSqlDate(infrigements[inf].fecha),
      "{COST}":infrigements[inf].costo,
      "{DETAIL}":infrigements[inf].detalle,
    }
    parseInfrigements+=parseTemplate(props,INFRIGEMENT_TEMPLATE);
  }
  var result='<div class="col-xs-12"><h2><i>'+infrigements.length+' </i>Resultados</h2><div style=" max-height: 60vh; overflow-y: auto; margin-bottom: 20px;">'+parseInfrigements+'</div></div>';
  simpleAlert('<i class="fa fa-minus-circle fa-fw"></i> Multas',result);
}

function parseLabelInfrigement(state){
  switch (state) {
    case "saved":
      return '<span class="label label-warning">Vencida</span>';
      break;
    case "voluntary":
      return '<span class="label label-primary">Pago voluntario</span>';
      break;
    case "close":
      return '<span class="label label-default">Cerrada</span>';
      break;
    default:
    return "";
  }
}
