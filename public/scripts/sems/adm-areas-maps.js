var map;
var popup = L.popup();
var zone=[];
function markStreetZoneInMap(which){
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
							cleanMap(which);
							return false;
						}
        },
		success: {
			label: 'Guardar zonas',
			className: 'btn-success',
			callback: function() {
				if(zone.length<3){
					bootbox.dialog({
							message: 'Debe marcar como mínimo 3 puntos para agregar una area y tiene marcados: '+zone.length,
							title: 'Marcar más de 3 puntos',
							buttons: {success: {label: 'Guardar zonas',	className: 'btn-success' } }});
							return false;
						}
				saveStreetLocation(which);
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
					 //loadPreviousReferenceData(which);
		 			if($("#"+which+"Zone").val()!=""){
						var preZone=JSON.parse($("#"+which+"Zone").val());
						for(var i in preZone){
							pulseMarkerOnMap(preZone[i][0],preZone[i][1]);
						}
						var actual = new L.LatLng(preZone[0][0], preZone[0][1]);
	 					map.setView(actual, 15);
					}
					loadPreviousReferenceData(which);
    });


}
// En el mapa marcar las calles ya marcadas!!
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
function cleanMap(which){
	zone=[];
	map.eachLayer(function(layer){
		map.removeLayer(layer);
	});
	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
 attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
 maxZoom: 22
 }).addTo(map);
 loadPreviousReferenceData(which);
}
function loadPreviousReferenceData(which){
	var active=$('#datatables1 > tbody > tr.active').children( 'td:eq(0)' ).text();
	$('#datatables1').DataTable().rows().every( function ( rowIdx, tableLoop, rowLoop ) {
			var data = this.data();
			var latlngs = JSON.parse(data[5]);// Lugar en data donde esta el GPS en las areas
			if(!(which=='edit' && data[0]==active)){// data[0] es el id en area
				var polygon = L.polygon(latlngs,{color: 'green'}).addTo(map);
			}
	} );
}
// Validar que sean 4 puntos los que se marcaron para la calle!
function saveStreetLocation(which){
		var position =window.marker.getLatLng();
		var map=null;
		var popup = L.popup();
		window.marker=null;
		$("#"+which+"Zone").val(JSON.stringify(zone));
		zone=[];
		return true;
}
