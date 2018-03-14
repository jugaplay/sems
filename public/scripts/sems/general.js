function simpleAlert(title,message){
  bootbox.dialog({
    message: message,
    title: title,
    buttons: {
      success: {
        label: 'Aceptar',
        className: 'btn-success'
      }
    }
  });
}
function parseDate(jsDate){
    return parse0LessThan10(jsDate.getHours())+':'+parse0LessThan10(jsDate.getMinutes())+' Hs '+parse0LessThan10(jsDate.getDate())+'/'+lettersOfMonth(jsDate.getMonth());
}
function parse0LessThan10(int){
	var int=parseInt(int);
	if(int<10){return"0"+int;}else{return int;}
}
function lettersOfMonth(nro){
  var months=["ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC"];
	return months[nro];
}
function returnFullMonthName(month){
	var months=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Ocutbre","Noviembre","Diciembre"];
	return months[nro];
}
