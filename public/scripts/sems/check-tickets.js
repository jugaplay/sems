// [-43.30062290009731,-65.1072911945994]
$( document ).on( 'submit', '#ticketFormControl', function(e){
  e.preventDefault();
  // controlPlate
  var plate = $("#controlPlate").val();
  if(!preVerifiedPlate(plate)){
    
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
                  url: window.apiUrl+"tickets/controlparking",
                  dataType: "json",
                  data: datas
                })
                .done(function(xhr) {
                  console.log(JSON.stringify(xhr));
                  if(xhr.hasOwnProperty('alert')){
                    hasInfringement(xhr.infringement);
                  }else if (xhr.hasOwnProperty('infringement')) {
                    newInfringement(xhr.infringement);
                  }else if (xhr.hasOwnProperty('error')) {
                    simpleAlert("Cuadra sin costo",xhr.error);
                  }else{// tiene ticket
                    hasTicket(xhr.ticket);
                  }
                  $( '#ticketFormControl' )[0].reset();
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
function hasTicket(ticket){
  // plate end_time 'type', //(time/day)
  var end_time=parseDate(new Date(ticket.end_time));
  if(ticket.type=='day'){// e
    toastr.success( 'Patente <b>' + ticket.plate + '</b> tiene una estadia' );
  }else{
    toastr.success( 'Patente <b>' + ticket.plate + '</b> tiene reservado hasta '+end_time );
  }
}
// dialog.modal('hide') // Para esconder todos
