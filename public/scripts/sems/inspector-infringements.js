(function(){

//--------------------------------
  //evento de pulsar boton
	//Marco en el mapa los puntos previos
    var jqxhr = $.ajax({
                    method: "GET",
                    url: window.apiUrl+"infringements/all"
                  })
                  .done(function(xhr) {
                    //console.log(JSON.stringify(xhr));
                    loadinfringements(xhr);
                  })
                  .fail(function(xhr) {
                    if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                    else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                    else{
                      toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                   }
                  });

})(window);
function loadinfringements(infringements){
  var navs='';
  var tabs='';
  var options='';
  for(infringement in infringements){
      var active = (infringement==0)?"active":"";
      navs+=' <li><a href="#infrig'+infringement+'" class="'+active+'" tabindex="-1" data-toggle="tab">'+infringements[infringement].name+'</a></li>';
      tabs+='<div class="tab-pane fade '+active+' in" id="infrig'+infringement+'"><p><strong>'+infringements[infringement].name+'</strong> '+infringements[infringement].detail+'</p></div>';
      options+='<option value="'+infringements[infringement].id+'">'+infringements[infringement].name+'</option>';
    }
    var props = {
    		'{INFRINGEMENTS_NAV}' : navs,
    		'{INFRINGEMENTS_TABS}' : tabs,
        '{INFRINGEMENTS_OPTIONS}':options
    	}
      $("#main-content-insp").html(parseTemplate(props, INFRINGMENT_INSPECTOR_HTML));
}

$( document ).on( 'submit', '#inspectorInfringementForm', function(e){
  e.preventDefault();
  var plate = $("#infringementPlate").val();
  if(!preVerifiedPlate(plate)){
    
    return false;
  }
  // controlPlate
  var  datas = $("#inspectorInfringementForm").serializeArray();
  var latlng=[-43.30036707711908,-65.10553647527931];
  datas.push({name: "latlng", value: JSON.stringify(latlng)});
  var $button = $("#inspectorInfringementForm [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  url: window.apiUrl+"infringements",
                  data: datas
                })
                .done(function(xhr) {
                  console.log(JSON.stringify(xhr));
                  newInfringement(xhr);
                  $( '#inspectorInfringementForm' )[0].reset();
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{
                    toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                 }
                })
                .always(function(){
                  $button.button('reset');
                });
});
var INFRINGMENT_INSPECTOR_HTML=''
+'<div class="content-body">'
+'    <div class="row">'
+'        <div class="col-md-6 col-md-offset-3 col-xs-12">'
+'            <div class="panel fade in panel-default" data-init-panel="true">'
+'                <div class="panel-heading">'
+'                    <h3 class="panel-title"><i class="fa fa-warning fa-fw" aria-hidden="true"></i> Detalle de infracciones</h3>'
+'                </div>'
+'                <ul class="nav nav-tabs" id="demo1-tabs">'
+'                    <li class="dropdown">'
+'                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tipos de infracciones <i class="fa fa-angle-down"></i></a>'
+'                        <ul class="dropdown-menu dropdown-menu-right" role="menu">'
+'                          {INFRINGEMENTS_NAV}'
+'                        </ul>'
+'                      </li>'
+'                </ul>'
+'                <div class="panel-body">'
+'                    <div class="tab-content">'
+'                        {INFRINGEMENTS_TABS}'
+'                    </div>'
+'                    <!-- /tab-content -->'
+'                </div>'
+'                <!-- /panel-body -->'
+'            </div>'
+'            <!-- /.panel -->'
+'        </div>'
+'    </div>'
+'    <div class="row">'
+'        <div class="col-md-6 col-md-offset-3 col-xs-12">'
+'            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
+'                <div class="panel-heading">'
+'                    <h3 class="panel-title"><i class="fa fa-warning fa-fw" aria-hidden="true"></i> Generar infracción</h3>'
+'                </div>'
+'                <div class="panel-body">'
+'                    <form role="form" id="inspectorInfringementForm">'
+'                        <div class="form-group form-group-lg">'
+'                            <label for="sel1">Tipo de infraccion:</label>'
+'                            <select class="form-control" id="infringementCausesId" name="infringementCausesId"  required="">'
+'                                {INFRINGEMENTS_OPTIONS}'
+'                            </select>'
+'                        </div>'
+'                        <!--/form-group-->'
+'                          <div class="form-group form-group-lg">'
+'                            <label class="control-label" for="mask-date">Patente</label>'
+'                            <div class="input-group input-group-in">'
+'                                <span class="input-group-addon">'
+'                                    <i class="fa fa-car"></i>'
+'                                </span>'
+'                                <input type="text" class="form-control input-lg" name="infringementPlate" id="infringementPlate" placeholder="Patente" required="">'
+'                            </div>'
+'                            <!-- /input-group-in -->'
+'                          </div>'
+'                          <!--/form-group-->'
+'                        <div class="form-group form-group-lg">'
+'                            <label for="inputTextarea">Detalle</label>'
+'                            <textarea rows="5" class="form-control" name="infringementDetail" id="infringementDetail" placeholder="Detalle"  required=""></textarea>'
+'                        </div>'
+'                        <!-- /form-group -->'
+'                        <!--/form-group-->'
+'                        <div class="form-group form-group-lg">'
+'                            <input type="hidden" name="_token" value="'+window.ajax_token+'">'
+'                            <button type="submit" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> Procesando" class="btn btn-primary btn-lg">'
+'                               Realizar multa'
+'                             </button>'
+'                        </div>'
+'                    </form>'
+'                    <!--/form-->'
+'                </div>'
+'                <!-- /panel-body -->'
+'            </div>'
+'            <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->'
+'        </div>'
+'        <!-- /.col-md-6 col-md-offset-3 col-xs-12 -->'
+'    </div>'
+'    <!-- /.row -->'
+'</div>'
