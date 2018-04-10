(function(){
window.userdata=null;
  $("#creditMail").focusout(function() {
    searchForUserData();
  });
  $("#checkUsersData").focusout(function() {
    // Show users data if found
    showUserData();
  });
  $("#ticketPayment").change(function(){
    checkCreditPayment();
  });
})(window);
$( document ).on( 'submit', '#creditFormContainer', function(e){
  e.preventDefault();
  var $this = $( this ),
  datas = $this.serializeArray(); // or use $this.serialize()
  // do server action to save change here ( ajax )

  $.each( datas, function( i, data ){
    console.log( data.name + ' = ' + data.value );
  });
  var price= $("#creditAmount").val();
  if(price<=0){
    simpleAlert("Monto incorrecto","El dinero a transferir tiene que ser mayor a 0");
    return false;
  }
  if($("#creditPayment").val()=="EF"){ // Lo compra con credito
    // Verifico previo que tenga credito
    console.log("En Efectivo");
    var walletBalance=parseFloat($("#wallet-balance").val());
    var walletCredit=parseFloat($("#wallet-credit").val());
    if(price>(walletBalance+walletCredit)){ // No le da el CREDITO
      notEnoughCredit();
    }else {
      sendMoneyWithCredit(datas);
    }
  }else{
    console.log("Procesador de pago");
    alert("Procesador de pago");
    sendMoneyWithCredit(datas);// Por ahora esto anda, pero deberia pasar por el procesador
  }
});
function sendMoneyWithCredit(datas){
  var $button = $("#creditFormContainer [type=submit]");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"credit",
                  data: datas
                })
                .done(function(xhr) {
                  toastr.success( 'Credito enviado exitosamente!' );
                  console.log(JSON.stringify(xhr));
                  alertSuccessCredit(xhr.bill_id,xhr.amount,xhr.user_name,xhr.user_wallet);
                  $( '#creditFormContainer' )[0].reset();
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
function searchForUserData(){
  var email = $("#creditMail").val();
  var datas = JSON.stringify({"email":email});
  var $button = $("#checkUsersData");
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"credit/checkuser",
                  dataType: "json",
                  data: datas
                })
                .done(function(xhr) {
                  toastr.success( 'Usuario: <b> '+xhr.name+' </b> encontrado' );
                  console.log(JSON.stringify(xhr));
                  window.userdata=xhr;
                  $("#creditMail").parent().parent().removeClass("has-error");
                  $("#creditMail").parent().parent().addClass("has-success");
                })
                .fail(function(xhr) {
                  if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                  else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                  else{
                    toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                    $("#creditMail").parent().parent().removeClass("has-success");
                    $("#creditMail").parent().parent().addClass("has-error");
                    window.userdata=null;
                 }
                })
                .always(function(){
                  $button.button('reset');
                });
}
function showUserData(){
  if(window.userdata!=null){
    var title="Datos del usuario";
    var message="Nombre: <b>"+window.userdata.name+"</b>";
  }else{
    var title="Usuario no encontrado";
    var message="No se encontró ningún usuario con el mail: "+$("#creditMail").val();
  }
  simpleAlert(title,message);
}
function alertSuccessCredit(bill_id,amount,user_name,user_wallet){
  var detail="Enviado: <b>"+amount+"</b></br>"
  +"Usuario: <b>"+user_name+"</b></br>"
  +"Balance actual de "+user_name+" : <b>"+user_wallet+"</b>";
  bootbox.dialog({
    message: detail,
    title: 'Transferencia realizada exitosamente',
    buttons: {
      mail: {
        label: '<i class="fa fa-envelope"></i> Mail',
        className: 'btn-info',
        callback: function() {
          sendMail(bill_id);
          return false;
        }
      },
      sms: {
        label: '<i class="fa fa-mobile-phone"></i> SMS',
        className: 'btn-warning',
        callback: function() {
          sendSms(bill_id);
          return false;
        }
      },
      bill: {
        label: '<i class="fa fa-pencil-square-o"></i> Factura',
        className: 'btn-primary',
        callback: function() {
          openBill(bill_id);
          return false;
        }
      },
      success: {
        label: 'Aceptar',
        className: 'btn-success',
        callback: function() {
          location.reload();
        }
      }
    }
  });
}
