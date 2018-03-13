// [-43.30062290009731,-65.1072911945994]
$( document ).on( 'submit', '#ticketFormControl', function(e){
  e.preventDefault();
  // controlPlate
  var plate = $("#controlPlate").val();
  if(!preVerifiedPlate(plate)){
    simpleAlert("Patente incorrecta","La patente <b>"+plate+"</b> está mal ingresada por favor verifique la misma ");
    return false;
  }
  var latlng=[-43.30036707711908,-65.10553647527931];// va en la cuadra del quiosco
  var datas = JSON.stringify({"plate":plate,"latlng":latlng});
  var $button = $("#ticketFormControl [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: "tickets/controlparking",
                  dataType: "json",
                  data: datas
                })
                .done(function(xhr) {
                  //toastr.success( 'Usuario: <b> '+xhr.name+' </b> encontrado' );
                  console.log(JSON.stringify(xhr));
                  // Puede recibir un:
                  // alert ( Ya tiene infracción para el día de hoy y esta cuadra )
                  // Objeto Infringement -- con el id, para mandarle foto y detalle
                  //
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
function preVerifiedPlate(plate){
  return plate.length>=6;
}
