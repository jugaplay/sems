(function(){
  window.map;
  var popup = L.popup();
  var zone=[];
	map = new L.Map('map');
	popup = new L.Popup();
	zone=[];
	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
 maxZoom: 22
 }).addTo(map);
	map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.
//---------------------------
 var actual = new L.LatLng(-43.30023779290476, -65.10553300380707);
	map.setView(actual, 13);
//--------------------------------
  //evento de pulsar boton
	//Marco en el mapa los puntos previos
    var jqxhr = $.ajax({
                    method: "GET",
                    url: "spacereservations/active"
                  })
                  .done(function(xhr) {
                    console.log(JSON.stringify(xhr));
                    markSpecialSpacesInMap(xhr);
                  })
                  .fail(function(xhr) {
                    if(xhr.status==419){toastr.error('Error: Refresque la pagina y vuelva a intentar');}
                    else if (xhr.status>=500) { toastr.error('Error: Interno del servidor');}
                    else{
                      toastr.error('Error: '+JSON.parse(xhr.responseText).error);
                   }
                  });
})(window);
function markSpecialSpacesInMap(spaces){
  var markerLocation;var latlng;
  for(space in spaces){
    latlng=JSON.parse(spaces[space].latlng); 
    markerLocation = new L.LatLng(latlng[0],latlng[1]);
    marker = new L.Marker(markerLocation);
    window.map.addLayer(marker);
    marker.bindPopup("<b>Tipo:</b> "+spaces[space].type+"<br/><b>Identificador:</b> "+spaces[space].identifier+"<br/><b>Compañia:</b> "+spaces[space].company+"<br/><b>Espacios:</b> "+spaces[space].size+"<br/><b>Fin:</b> "+parseSqlDate(spaces[space].end_time)+"<br/>");
  }
}
