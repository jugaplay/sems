var map;
var popup = L.popup();
function markLocalInMap(which){
	// which can be create or edit
	//editLatitud editLongitud
	bootbox.dialog({
	message: '<div id="map" style="height: 70vh;"></div>',
	title: 'Marcar el local en el mapa',
	buttons: {
		success: {
			label: 'Marcar',
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
		 			// Marco en el mapa el punto previo si es que existe
		 			if($("#"+which+"Latitud").val()!="" && $("#"+which+"Longitud").val()!=""){
						pulseMarkerOnMap($("#"+which+"Latitud").val(),$("#"+which+"Longitud").val());
						var actual = new L.LatLng($("#"+which+"Latitud").val(), $("#"+which+"Longitud").val());
	 					map.setView(actual, 18);
					}

    });


}
function onMapClick(e) {pulseMarkerOnMap(e.latlng.lat,e.latlng.lng);}
function pulseMarkerOnMap(lat,lon){
		var markerLocation = new L.LatLng(lat, lon);
		if(window.marker!=null){
			window.marker.setLatLng(markerLocation);
		}else{
			window.marker = new L.Marker(markerLocation, {draggable:true});
			map.addLayer(marker);
			marker.bindPopup("<b>Local</b><br/>Añade el local al mapa, arrastrar hasta el punto exacto.").openPopup();
		}
}
function saveLocalLocation(which){
	var position =window.marker.getLatLng();
	var map=null;
	var popup = L.popup();
	window.marker=null;
		$("#"+which+"Latitud").val(position.lat);
		$("#"+which+"Longitud").val(position.lng);
	//alert("Latitude: "+position.lat+", longitude:"+position.lng);
}
