(function(){
// Agregar hora de ahora
// Avisar fraccion minima, de tanto! -- Lo compara contra el ahora siemrpe!!
// Previo a esto me mandaba una tabla con precios de 24 horas

var priceTime=JSON.parse($("#price-time").val());
var priceDay=JSON.parse($("#price-day").val());
var walletBalance=$("#wallet-balance").val();
var walletCredit=$("#wallet-credit").val();
console.log('horas='+JSON.stringify(priceTime));
console.log('dia='+JSON.stringify(priceDay));
console.log('balance='+JSON.stringify(walletBalance));
console.log('credito='+JSON.stringify(walletCredit));
var now=new Date();// HH:mm
$("#ticket-time").val(parseDateForTimeInput(now));
$("#ticket-time").focusout(function() {
  setPriceForTime()
});
$("#ticket-payment").change(function(){
	alert("Revisar credito");
});
})(window);
// ticket-day
function parseDateForTimeInput(time){
	return add0IfLessThan10(time.getHours())+':'+add0IfLessThan10(time.getMinutes());
}
function add0IfLessThan10(val){
	return (val < 10 ? "0"+val : val);
}
function setToDayTicket(){
	var priceDay=parseInt(JSON.parse($("#price-day").val()));
	$("#ticket-time").val("00:00");
	$("#ticket-day").val("true");
	finalPrice(priceDay);
}
function setPriceForTime(){
	alert("Cambio el precio");
	if($("#ticket-day").val()=="true"){
		// pregunta si desea sacar la estadia
		$("#ticket-day").val("false");
	}else{

	}
}
function finalPrice(price){
	var walletBalance=$("#wallet-balance").val();
	var walletCredit=$("#wallet-credit").val();
	$("#ticket-cost input").val(price);
	var credito = ($("#ticket-payment").val()=="EF");
	if(credito && (price>(walletBalance+walletCredit))){
		// No le da el credito para hacer la venta
		alert("no le da");
		$("#ticket-cost input").addClass("no-credit");
		$("#ticket-cost a").title="No tiene crédito suficiente para la venta";
		$("#ticket-cost i").attr('class', 'fa fa-remove');
	}else{
		// si le da el credito para hacer la venta
		alert("le da");
		$("#ticket-cost input").removeClass("no-credit");
		$("#ticket-cost a").title="Puede realizar la venta";
		$("#ticket-cost i").attr('class', 'fa fa-check');
	}
}
// Remover estadia?
// Boton desea agregar estadia
// ticket-payment -- EF ON
/*
	id="ticket-cost"
	al input (Value le ponemos el monto)
	// Si es credito y no le da la suma del CREDITO
		la clase del input tiene no-credit y el i es fa fa-remove
		a title="Puede realizar la venta"
 // Sino
  la clase del input no tiene no-credit y el i es fa fa-check
	a title="No tiene crédito suficiente para la venta"

	getHours()	Returns the hour (from 0-23)
	getMilliseconds()	Returns the milliseconds (from 0-999)
	getMinutes()
*/
