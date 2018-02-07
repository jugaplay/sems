var map;
var popup = L.popup();
var zone=[];
function markSpecialVehiclesZoneInMap(which){
	// which can be create or edit
	//editLatitud editLongitud
	bootbox.dialog({
	message: '<div id="map" style="height: 70vh;"></div>',
	title: 'Marcar la zona correspondiente en el mapa',
	buttons: {
		cancel: {
            label: 'Limpiar Mapa',
            className: 'btn-danger',
						callback: function() {
							cleanMap();
							return false;
						}
        },
		success: {
			label: 'Guardar zonas',
			className: 'btn-success',
			callback: function() {
				saveLocalLocation(which);
			}
		}
	}
	}).on('shown.bs.modal', function (e) {
        // do something...

					window.marker=null;
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
					map.on('click', onMapClick);
		 //evento de pulsar boton
		 			 //Marco en el mapa los puntos previos
		 			if($("#"+which+"Zone").val()!=""){
						var preZone=JSON.parse($("#"+which+"Zone").val());
						for(var i in preZone){
							pulseMarkerOnMap(preZone[i][0],preZone[i][1]);
						}
						var actual = new L.LatLng(preZone[0][0], preZone[0][1]);
	 					map.setView(actual, 15);
					}

    });


}
function onMapClick(e) {pulseMarkerOnMap(e.latlng.lat,e.latlng.lng);}
function pulseMarkerOnMap(lat,lon){
		var markerLocation = new L.LatLng(lat, lon);
		window.marker = new L.Marker(markerLocation);
		map.addLayer(marker);
		if(zone.length>0){
			var p1 = new L.LatLng(zone[zone.length-1][0], zone[zone.length-1][1]);
			var p2 = new L.LatLng(lat,lon);
			polygonPoints =[p1,p2];
			var polygon = new L.polyline(polygonPoints);
			map.addLayer(polygon);
			}
		zone.push([lat,lon]);
}
function cleanMap(){
	zone=[];
	map.eachLayer(function(layer){
		map.removeLayer(layer);
	});
	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
 maxZoom: 22
 }).addTo(map);

}
function saveLocalLocation(which){
	var position =window.marker.getLatLng();
	var map=null;
	var popup = L.popup();
	window.marker=null;
	$("#"+which+"Zone").val(JSON.stringify(zone));
	zone=[];
	//alert("Latitude: "+position.lat+", longitude:"+position.lng);
}
