/* Usuarios sin login */
function openPhotoSwipe() {
    var pswpElement = document.querySelectorAll('.pswp')[0];
    // build items array
    var items = [
        {
            src: '../images/dummy/uifaces10.jpg',
            w: 964,
            h: 1024
        },
        {
            src: '../images/dummy/uifaces11.jpg',
            w: 1024,
            h: 683
        }
    ];

    // define options (if needed)
    var options = {
             // history & focus options are disabled on CodePen
        history: false,
        focus: false,

        showAnimationDuration: 0,
        hideAnimationDuration: 0

    };

    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
};
function showInfringementDetail(){
  alert("Muestra el detalle del tipo de multa");
}
function showInMap(){
  alert("Muestra punto en el mapa");
}
function showalert(){
  alert("Correr funcion");
}
function dontChargeInfraction(){
  alert("Perdona");

}
function chargeInfraction(){
  var VOUCHER_TEMPLATE=''
+'            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
+'              <div class="panel-body big-bootbox">'
+'                <form role="form">'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Precio de cierre</label>'
+'                        <div class="input-group input-group-in">'
+'                            <span class="input-group-addon">'
+'                                <i class="fa fa-usd"></i>'
+'                            </span>'
+'                            <input type="text" class="form-control input-lg" id="inputPass" value="600" > </div>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                    <!--/form-group-->'

+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Comentario</label>'
+'                            <textarea rows="5" class="form-control" id="inputTextarea" placeholder="Detalle"></textarea>'
+'                        <!-- /input-group-in -->'
+'                    </div>'
+'                  </form>'
+'              </div><!-- /panel-body -->'
+'            </div>';
  bootbox.dialog({
    message: VOUCHER_TEMPLATE,
    title: '<i class="fa fa-ticket fa-fw" aria-hidden="true"></i> Cerrar',
    buttons: {
      success: {
        label: 'Cobrar',
        className: 'btn-success',
        callback: function() {
          alert('Cierra la multa');
        }
      }
    }
  });
}
function dontChargeInfraction(){
  var VOUCHER_TEMPLATE=''
+'            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">'
+'              <div class="panel-body big-bootbox">'
+'                <form role="form">'
+'                    <div class="form-group form-group-lg">'
+'                        <label class="control-label" for="mask-date">Comentario</label>'
+'                            <textarea rows="5" class="form-control" id="inputTextarea" placeholder="Detalle"></textarea>'
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
          alert('Cierra la multa');
        }
      }
    }
  });
}
