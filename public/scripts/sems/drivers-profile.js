$( document ).on( 'submit', '#configurationForm', function(e){
  e.preventDefault();
  var $this = $( this ),
  datas = $this.serializeArray(); // or use $this.serialize()
  // do server action to save change here ( ajax )

  $.each( datas, function( i, data ){
    console.log( data.name + ' = ' + data.value );
  });
  if($("#configurationPassword").val()!="" && $("#configurationPassword").val().length<6){
    simpleAlert("Al menos 6 caracteres","La contraseña tiene que tener por lo menos 6 caracteres.");
    return false;
  }
  if(editSensibleFields()){
    askPassword(datas);
  }else {
    sendConfigurationToServer(datas);
  }
});
function editSensibleFields(){// Chequea si necesita pedir la password para el cambio
  return (!($("#configurationMail").val()==$("#configurationMail_old").val()&&$("#configurationPhone").val()==$("#configurationPhone_old").val()&&$("#configurationPassword").val()==""));
}
// ticketDay

function askPassword(datas){ // calculateTimePrice
    bootbox.dialog({
  	message: '<p>Esta por realizar cambios sensibles de información por lo que es necesario ingresar su contraseña </p><div class="form-group form-group-lg"> <label class="control-label" for="mask-datetime">Contraseña</label> <input type="password" class="form-control input-lg" id="configurationActualPassword" name="configurationActualPassword" placeholder="Contraseña"> </div>',
  	title: 'Contraseña requerida ',
  	buttons: {
  		cancel: {
              label: 'Cancelar',
              className: 'btn-danger'
          },
  		success: {
  			label: 'Aceptar',
  			className: 'btn-success',
  			callback: function() {
          if($("#configurationActualPassword").val()==""){
            toastr.error('Ingrese una contraseña valida');
            return false;
          }else{
            datas.push({name: "configurationActualPassword", value: $("#configurationActualPassword").val()});
            sendConfigurationToServer(datas);
          }
  			}
  		}
  	}
  });
}
function sendConfigurationToServer(datas){
  var $button = $("#configurationForm [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"users/edit",
                  data: datas
                })
                .done(function(xhr) {
                  toastr.success( 'Cambios guardados exitosamente!' );
                  console.log("Respuesta: "+JSON.stringify(xhr));
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{ toastr.error('Error: '+JSON.parse(xhr.responseText).error); }
                })
                .always(function(){
                  $button.button('reset');
                });
}
