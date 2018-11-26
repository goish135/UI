var global_decorator;
var map = L.map('map').setView([23, 121], 200);
function d(start, end) 
{
	
		
	$.getJSON("https://nominatim.openstreetmap.org/search.php?",{"format":"json","zoom":18,"addressdetails":1,"q":start}, function(data1) { 
		//console.log(data1[0]['lat'])
		//console.log(data1[0]['lon'])
		p1 = data1[0]['lat']+','+data1[0]['lon']
		//console.log(p1)
		rn=p1
	
	
	$.getJSON("https://nominatim.openstreetmap.org/search.php?",{"format":"json","zoom":18,"addressdetails":1,"q":end},function(data2){
		//console.log(data2[0]['lat'])
		//console.log(data2[0]['lon'])
		p2 = data2[0]['lat']+','+data2[0]['lon']
		//console.log(p2)
	
	console.log(p1)
	console.log(p2)
	

	$.get("HomeController2.php?start="+p1+"&end="+p2, function (data3) {
		console.log(data3);
		var jdata = JSON.parse(data3);
		console.log(jdata)
		console.log(jdata['time']+'s')
		var timeInfo = jdata['time']+'s';
		var disInfo  = jdata['distance']+'m';
		var insInfo  = jdata['roadsection'];
		$("#times").append(timeInfo+'<br>');
		$("#distance").append(disInfo+'<br>')
		
		
		for(var v in insInfo)
		{
			console.log(insInfo[v])
			$("#ins").append(insInfo[v]+'<br>')
		}
		
		
		// var latlngs = L.PolylineUtil.decode(jdata['waypoint'])
		var latlngs = jdata['waypoint'];
		var latlng2 =[];
		var cnt = 0;
		for(var atng in latlngs)
		{
				console.log(latlngs[atng])
				// console.log('lng'+latlngs[atng][0])
				// console.log('lat'+latlngs[atng][1])
				var temp = latlngs[atng][0]
				latlngs[atng][0] = latlngs[atng][1]
				latlngs[atng][1] = temp
				console.log('lng'+latlngs[atng][0])
				console.log('lat'+latlngs[atng][1])
				latlng2.push([latlngs[atng][0],latlngs[atng][1]])
				cnt = cnt + 1;
		}
		
		console.log(latlng2[0])
		
		// var polyline = L.polyline(latlngs);
		/*
		$.each(jdata.paths[0].instructions, function (k, v) {
		console.log(k)
		$("#route-list tbody").append("<tr id='" + L.PolylineUtil.encode([latlngs[v.interval[0]],latlngs[v.interval[1]]]) + "' class='route-row'><td>" + v.text + "</td></tr>");
		})
		*/
		
		// map.removeLayer(global_decorator);
		var mycolor = "#00ffff"
		var polyline = L.polyline(latlng2, {color: mycolor}).addTo(map);
		
		var myIcon = L.icon({
			iconUrl: 'https://i.imgur.com/Cl0V59c.png',
			iconSize: [38, 95],
			iconAnchor: [19, 42],
			popupAnchor: [-3, -76],

		});
		L.marker([50.505, 30.57], {icon: myIcon}).addTo(map);
		
		
		
		
		
		var marker = L.Marker.movingMarker(latlng2, 10000, {icon: myIcon}).addTo(map);
		marker.once('click', function () {
			marker.start();
			marker.closePopup();
			marker.unbindPopup();
			marker.on('click', function() {
			if (marker.isRunning()) {
				marker.pause();
			} else {
				marker.start();
			}
			});
			setTimeout(function() {
				marker1.bindPopup('<b>Click me to pause !</b>').openPopup();
			}, 2000);
		});
		
		// global_decorator = decorator;
  
		// map.setView([latlngs[0][0] - 0.001, latlngs[0][1]], 17)
		
	
	}); // navigator 
	
	}); // end
	}); // start
}
