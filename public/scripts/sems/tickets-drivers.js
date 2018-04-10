(function(){

window.now=new Date();// HH:mm
$("#ticketTime").val(parseDateForTimeInput(window.now));
$("#ticketTime").focusout(function() {
  setPriceForTime(calculateTimePrice);
});
$("#ticketHours").focusout(function() {
  setPriceForTime(calculateHourPrice);
});
$("#ticketPayment").change(function(){
  checkCreditPayment();
});
})(window);
$( document ).on( 'submit', '#ticketFormContainer', function(e){
  e.preventDefault();
  var $this = $( this ),
  datas = $this.serializeArray(); // or use $this.serialize()
  // do server action to save change here ( ajax )

  $.each( datas, function( i, data ){
    console.log( data.name + ' = ' + data.value );
  });
  $("#ticketPlate").val(parsePlate($("#ticketPlate").val()));
  var plate = $("#ticketPlate").val();
  if(!preVerifiedPlate(plate)){

    return false;
  }
  if($("#ticketPayment").val()=="EF"){ // Lo compra con credito
    // Verifico previo que tenga credito
    console.log("En Efectivo");
    var walletBalance=parseFloat($("#wallet-balance").val());
    var walletCredit=parseFloat($("#wallet-credit").val());
    var price= $("#ticket-cost input").val();
    if(price>(walletBalance+walletCredit)){ // No le da el CREDITO
      simpleAlert("Crédito insuficiente","No tiene suficiente crédito como para realizar la compra.");
    }else {
      checkIfSavedPlate(datas);
    }
  }else{
    console.log("Procesador de pago");
    alert("Procesador de pago");// No olvidar de que hacer al guardar la patente!
  }
});
// ticketDay
function parseDateForTimeInput(time){
	return add0IfLessThan10(time.getHours())+':'+add0IfLessThan10(time.getMinutes());
}

function parseDateFromTimeInput(timeString){
  var date = new Date(JSON.parse(JSON.stringify(window.now)));// Clonar
  console.log(date);
  var hour=parseInt(timeString.substring(0, 2));
  var minutes=parseInt(timeString.substring(3, 5));
  if(date.getHours()>hour){// Le agrego un dia
    date.setDate(date.getDate()+1);
  }
  date.setHours(hour);
  date.setMinutes(minutes);
  console.log(date);
  return date;
}
function add0IfLessThan10(val){
	return (val < 10 ? "0"+val : val);
}
function setToDayTicket(){
	var priceDay=parseInt($("#price-day").val());
  $("#ticketHours").val(0);
	$("#ticketTime").val("00:00");
	$("#ticketDay").val("true");
	finalPrice(priceDay);
}
function setPriceForTime(fuctionToExecute){ // calculateTimePrice
	if($("#ticketDay").val()=="true"){
		// pregunta si desea sacar la estadia
    bootbox.dialog({
  	message: '¿Desea remover la estadía para calcular el precio en horas?',
  	title: 'Remover estadía',
  	buttons: {
  		cancel: {
              label: 'Cancelar',
              className: 'btn-danger',
              callback: function() {
                setToDayTicket();
        			}
          },
  		success: {
  			label: 'Aceptar',
  			className: 'btn-success',
  			callback: function() {
          fuctionToExecute();
          $("#ticketDay").val("false");
  			}
  		}
  	}
  });
	}else{
    fuctionToExecute();
	}
}
function calculateHourPrice(){
  var minFraction=30;
  var minutes=parseFloat($("#ticketHours").val())*60;
  console.log("Minutes charged:"+minutes);
  var priceTime=JSON.parse($("#price-time").val());
  for(price in priceTime){
    priceTime[price].starts=new Date(priceTime[price].starts);
    priceTime[price].ends=new Date(priceTime[price].ends);
    priceTime[price].price=parseFloat(priceTime[price].price)/60;
  }
  var time = new Date();// Clonar
  var amount = 0;
  for (var minutesCharged=0;(minutesCharged%minFraction!=0 || minutes>minutesCharged) && priceTime.length>0 ;time.setTime(time.getTime()+1000*60)){
    if(priceTime[0].starts<time && priceTime[0].ends>=time){
      if(priceTime[0].price>0){
        amount+=priceTime[0].price;
        minutesCharged++;
      }
    }else if(priceTime[0].ends<time){
      priceTime.splice(0, 1);
      time.setTime(time.getTime()-1000*60);// Lo descuento asi lo vuelve a correr
    }
  }
  $("#ticketTime").val(parseDateForTimeInput(time));
  $("#ticketHours").val(parseFloat(minutesCharged/60).toFixed(1));
  finalPrice(parseFloat(amount).toFixed(2));
}
function calculateTimePrice(){
  var minFraction=30;
  var priceTime=JSON.parse($("#price-time").val());
  for(price in priceTime){
    priceTime[price].starts=new Date(priceTime[price].starts);
    priceTime[price].ends=new Date(priceTime[price].ends);
    priceTime[price].price=parseFloat(priceTime[price].price)/60;
  }
  var time = new Date();// Clonar
  var calculatedEnd = parseDateFromTimeInput($("#ticketTime").val());
  var amount = 0;
  for (var minutesCharged=0;(minutesCharged%minFraction!=0 || calculatedEnd>time) && priceTime.length>0 ;time.setTime(time.getTime()+1000*60)){
    if(priceTime[0].starts<time && priceTime[0].ends>=time){
      if(priceTime[0].price>0){
        amount+=priceTime[0].price;
        minutesCharged++;
      }
    }else if(priceTime[0].ends<time){
      priceTime.splice(0, 1);
      time.setTime(time.getTime()-1000*60);// Lo descuento asi lo vuelve a correr
    }
  }
  $("#ticketTime").val(parseDateForTimeInput(time));
  $("#ticketHours").val(parseFloat(minutesCharged/60).toFixed(1));
  finalPrice(parseFloat(amount).toFixed(2));
}
function checkCreditPayment(){
  finalPrice(parseInt($("#ticket-cost input").val()));
}

function finalPrice(price){
	var walletBalance=parseFloat($("#wallet-balance").val());
  var walletCredit=parseFloat($("#wallet-credit").val());
	$("#ticket-cost input").val(price);
	var credito = ($("#ticketPayment").val()=="EF");
	if(credito && (price>(walletBalance+walletCredit))){
		// No le da el credito para hacer la venta
		$("#ticket-cost").addClass("no-credit");
    $( "#ticket-cost a" ).attr( "data-original-title","No tiene crédito suficiente para realizar la compra");
		$("#ticket-cost a i").attr('class', 'fa fa-remove');
	}else{
		// si le da el credito para hacer la venta
		$("#ticket-cost").removeClass("no-credit");
    $( "#ticket-cost a" ).attr( "data-original-title","Puede realizar la compra");
		$("#ticket-cost a i").attr('class', 'fa fa-check');
	}
}
function buyTicketWithCredit(datas){
  var $button = $("#ticketFormContainer [type=submit]");
  datas.push({name: "latlng", value: JSON.stringify(window.userLocation)});
  $button.button('loading')
  var jqxhr = $.ajax({
                  method: "POST",
                  headers: {
                      'X-CSRF-TOKEN': window.ajax_token
                  },
                  url: window.apiUrl+"tickets/driverticket/create",
                  data: datas
                })
                .done(function(xhr) {
                  toastr.success( 'Ticket <b> '+xhr.plate+' </b> creado exitosamente!' );
                  console.log(JSON.stringify(xhr));
                  alertSuccessTicket(xhr.id,xhr.plate,xhr.type,xhr.time,xhr.start_time,xhr.end_time,xhr.token,xhr.bill);
                  $( '#ticketFormContainer' )[0].reset();
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
function checkIfSavedPlate(datas) {
  var plate = $("#ticketPlate").val();
  if(jQuery.inArray( plate, cars )==-1){
    bootbox.confirm({
      title: '<i class="fa fa fa-car fa-fw" aria-hidden="true"></i> Guardar vehiculo',
      message: "¿Desea agregar "+plate+" a sus vehiculos guardados?",
      buttons: {
          confirm: {
              label: 'Guardar',
              className: 'btn-success'
          },
          cancel: {
              label: 'No, gracias',
              className: 'btn-danger'
          }
      },
      callback: function(result){
        if(result){
          datas.push({name: "saveCar", value: "true"});
          buyTicketWithCredit(datas);
        }else{
          datas.push({name: "saveCar", value: "false"});
          buyTicketWithCredit(datas);
        }

    }
    });
  }else{
    datas.push({name: "saveCar", value: "false"});
    buyTicketWithCredit(datas);
  }
}
function alertSuccessTicket(id,plate,type,time,start_time,end_time,token,bill){
  // bill -- total, -- detail, -- id
  var paid=(type=="time")?time+" Horas":"Estadía";
  var detail="Patente: <b>"+plate+"</b></br>"
  +"Abonado: <b>"+paid+"</b></br>"
  +"Hasta las: <b>"+new Date(end_time)+"</b></br>"
  +"Precio: <b>$ "+bill.total+"</b> </br>"
  +"Codigo:  <b>"+token+"</b>";
  bootbox.dialog({
    message: detail,
    title: 'Ticket comprado exitosamente',
    buttons: {
      mail: {
        label: '<i class="fa fa-envelope"></i> Mail',
        className: 'btn-info',
        callback: function() {
          sendMail(id);
          return false;
        }
      },
      sms: {
        label: '<i class="fa fa-mobile-phone"></i> SMS',
        className: 'btn-warning',
        callback: function() {
          sendSms(id);
          return false;
        }
      },
      bill: {
        label: '<i class="fa fa-pencil-square-o"></i> Factura',
        className: 'btn-primary',
        callback: function() {
          openBill(id);
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
function sendMail(id){
  alert("Envia mail: "+id);
}
function sendSms(id){
  alert("Envia sms: "+id);
}
function openBill(id){
  alert("Abre factura: "+id);
}
