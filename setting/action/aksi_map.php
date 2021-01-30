<script type="text/javascript">
	function initialize() {
		var mapOptions = {
			zoom: 10,
			center: new google.maps.LatLng(<?=$r_tlokasi['lat'].", ".$r_tlokasi['lng'];?>)
		}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			setMarkers(map, beaches);
		}

		var beaches = [
			['PROV. <?=strtoupper($r_tprov['nama'])?> - <?=strtoupper($r_tkota['nama'])?> - KEC. <?=strtoupper($r_tkec['nama'])?> - KEL. <?=strtoupper($r_tkel['nama'])?>', <?=$r_tlokasi['lat'].", ".$r_tlokasi['lng'];?>],
		];

		function setMarkers(map, locations) {
		var shape = {
			coords: [1, 1, 1, 20, 18, 20, 18 , 1],
			type: 'poly'
		};
		var infoWindow = new google.maps.InfoWindow;
		for (var i = 0; i < locations.length; i++) {
			var beach = locations[i];
			var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				icon:'../../assets/img/icon/small-marker.png',
				shape: shape,
				title: beach[0],
				zIndex: beach[3]
			});
				var html = 'LOKASI : '+beach[0]+'';
				bindInfoWindow(marker, map, infoWindow, html);
			}
		}
	  
		function bindInfoWindow(marker, map, infoWindow, html) {
			google.maps.event.addListener(marker, 'click', function() {
				infoWindow.setContent(html);
				infoWindow.open(map, marker);
			});
		}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>