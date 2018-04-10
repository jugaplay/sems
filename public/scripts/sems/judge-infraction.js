
  function openPhotoSwipe(url) {
      var pswpElement = document.querySelectorAll('.pswp')[0];
      // build items array
      var items = [];
      var start=0;
      var myImgs = $(".kit-avatar img[name='kit-avatar-gallery']").each(function( index ) {
        items.push({src: $( this ).attr('src'),w: $( this ).get(0).naturalWidth ,h:  $( this ).get(0).naturalHeight});
        if(url==$( this ).attr('src')){start=index;}
      });
      // define options (if needed)
      var options = {
               // history & focus options are disabled on CodePen
          index: start,// Cual abre primero
          history: false,
          focus: false,
          showAnimationDuration: 0,
          hideAnimationDuration: 0
      };
      var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
      gallery.init();
  };
//
$( document ).on( 'submit', '#addCommentForm', function(e){
  e.preventDefault();
  var $this = $( this ),
  datas = $this.serializeArray(); // or use $this.serialize()
  // do server action to save change here ( ajax )
  if ($("#infringementComment").val().length<3){
    toastr.error('No se puede agregar un comentario vacío, debe escribir un texto.');
    return;
  }
  $.each( datas, function( i, data ){
    console.log( data.name + ' = ' + data.value );
  });
  var $button = $("#addCommentForm [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"infringements/comments",
                  data: datas
                })
                .done(function(xhr) {
                  toastr.success( 'Comentario agregado exitosamente!' );
                  console.log(JSON.stringify(xhr));
                  addComment(xhr.detail,xhr.user_name,xhr.user_img);
                  $( '#addCommentForm' )[0].reset();
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{ toastr.error('Error: '+JSON.parse(xhr.responseText).error); }
                })
                .always(function(){
                  $button.button('reset');
                });

});
function addComment(detail,user_name,user_img){
  var props={
    '{SRC}':window.baseUrl+user_img,
    '{USER_NAME}':user_name,
    '{DETAIL}':detail,
    '{DATE}':parseDateFull(new Date())
  }
  var COMMENT_TO_ADD=''
  +'  <div class="media">'
  +'      <div class="media-left">'
  +'          <a class="kit-avatar kit-avatar-32" href="#">'
  +'              <img class="media-object" src="{SRC}">'
  +'          </a>'
  +'      </div>'
  +'      <div class="media-body bordered-bottom">'
  +'          <p class="media-heading">'
  +'              <strong>{USER_NAME}</strong> {DETAIL}</p>'
  +'          <p class="text-muted">'
  +'              <small>{DATE}</small>'
  +'          </p>'
  +'      </div>'
  +'  </div>';
  $("#comments-of-users").append(parseTemplate(props,COMMENT_TO_ADD));
}
function showalert(){
  alert("Correr funcion");
}
function dontChargeInfraction(){
  alert("Perdona");

}
function chargeInfraction(json){
  var date = new Date(json.voluntary_end_date);
  var actual = new Date();
  var price = (date<actual)?json.cost:json.voluntary_cost;
  var detail = (date<actual)?"Precio de cierre":"Precio de pago voluntario";
  var props={
    '{PRICE}':price,
    '{DETAIL}':detail
  }
  var VOUCHER_TEMPLATE=''
+'            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
+'              <div class="panel-body big-bootbox">'
+'                <form role="form" id="close-infraction-form">'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">{DETAIL}</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-usd"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control input-lg" name="closePrice" value="{PRICE}" > </div>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                    <!--/form-group-->'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Comentario</label>'
+'                            <textarea rows="5" class="form-control" id="closeDetail" name="closeDetail" placeholder="Detalle"></textarea>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                  </form>'
+'              </div><!-- /panel-body -->'
+'            </div>';
  bootbox.dialog({
    message: parseTemplate(props,VOUCHER_TEMPLATE),
    title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Cerrar',
    buttons: {
      success: {
        label: 'Cobrar',
        className: 'btn-success',
        callback: function() {
          chargeInfractionSend();
          return false;
        }
      }
    }
  });
}
function dontChargeInfraction(){
  var VOUCHER_TEMPLATE=''
+'            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
+'              <div class="panel-body big-bootbox">'
+'                <form role="form" id="close-infraction-form">'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Comentario</label>'
+'                            <input type="hidden" name="closePrice" value="0" >'
+'                            <textarea rows="5" class="form-control" id="closeDetail" name="closeDetail"  placeholder="Detalle"></textarea>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                  </form>'
+'              </div><!-- /panel-body -->'
+'            </div>';
  bootbox.dialog({
    message: VOUCHER_TEMPLATE,
    title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Perdonar',
    buttons: {
      success: {
        label: 'Perdonar',
        className: 'btn-success',
        callback: function() {
          chargeInfractionSend();
          return false;
        }
      }
    }
  });
}
function chargeInfractionSend(){
  if($("#closeDetail").val().length<3){
    toastr.error('Para cerrar la infracción es necesario completar el comentario.');
    return false;
  }
  var $this = $( "#close-infraction-form" ),
  datas = $this.serializeArray(); // or use $this.serialize()
  datas.push({name: "infringementId", value: $("#infringementId").val()});
  datas.push({name: "_token", value: $("input[name='_token']").first().val()});// Le pongo el valor
  $.each( datas, function( i, data ){
    console.log( data.name + ' = ' + data.value );
  }); // infringementId
  bootbox.hideAll();
  // do server action to save change here ( ajax )
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"infringements/close",
                  data: datas
                })
                .done(function(xhr) {
                  location.reload();
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{ toastr.error('Error: '+JSON.parse(xhr.responseText).error); }
                });
}
