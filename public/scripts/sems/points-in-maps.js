var map;
var popup = L.popup();
function showPointInMap(lat,lng){
	// which can be create or edit
	//editLatitud editLongitud
	bootbox.dialog({
	message: '<div id="map" style="height: 70vh;"></div>',
	title: 'Mapa',
	buttons: {
		success: {
			label: 'Cerrar',
			className: 'btn-success'
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
				 var markerLocation = new L.LatLng(lat, lng);
				 window.marker = new L.Marker(markerLocation);
	 				map.addLayer(marker);
					map.setView(markerLocation, 13);
			//--------------------------------


    });
}
