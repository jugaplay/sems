window.apiUrl="http://127.0.0.1:8000/";
window.baseUrl="http://127.0.0.1:8000/";
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
function parseSqlDate(date){
  return parseDate(new Date(date));
}
function parseDate(jsDate){
    return parse0LessThan10(jsDate.getHours())+':'+parse0LessThan10(jsDate.getMinutes())+' Hs '+parse0LessThan10(jsDate.getDate())+'/'+lettersOfMonth(jsDate.getMonth());
}
function parseDateFull(jsDate){
    return parse0LessThan10(jsDate.getHours())+':'+parse0LessThan10(jsDate.getMinutes())+' Hs '+parse0LessThan10(jsDate.getDate())+'/'+parse0LessThan10(jsDate.getMonth()+1)+'/'+jsDate.getFullYear();
}
function parseSimpleDate(jsDate){
  // 2018-03-08
  return jsDate.substring(8, 10)+"/"+jsDate.substring(5, 7)+"/"+jsDate.substring(0, 4);
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
function parseTemplate(props, template){
	var result = template;
	for (var key in props) {
  	while(result.indexOf(key) >= 0) {
    	result = result.replace(key,String(props[key]));
    }
  }
  return result;
}
function preVerifiedPlate(plate){
  if(plate.length<6){simpleAlert("Patente incorrecta","La patente <b>"+plate+"</b> está mal ingresada por favor verifique la misma ");}
  return plate.length>=6;
}
