!function(e){Array.prototype.forEach||(e.forEach=e.forEach||function(e,t){for(var i=0,a=this.length;i<a;i++)i in this&&e.call(t,this[i],i,this)})}(Array.prototype);var marker,mapObject,markers=[],markersData={Fastfood:[{name:"King Food",location_latitude:48.873792,location_longitude:2.295028,map_image_url:"img/thumb_map_fastfood_1.jpg",name_point:"King Food",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"},{name:"Catrine",location_latitude:48.856614,location_longitude:2.352222,map_image_url:"img/thumb_map_fastfood_2.jpg",name_point:"Catrine",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"}],Pizza:[{name:"Bella Napoli",location_latitude:48.865633,location_longitude:2.321236,map_image_url:"img/thumb_map_pizza_1.jpg",name_point:"Bella Napoli",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"}],Chinese:[{name:"Dragon Tower",location_latitude:48.863893,location_longitude:2.342348,map_image_url:"img/thumb_map_chinese_1.jpg",name_point:"Dragon Tower",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"}],Fish:[{name:"SeaFood",location_latitude:48.85837,location_longitude:2.294481,map_image_url:"img/thumb_map_fish_1.jpg",name_point:"SeaFood",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"}],International:[{name:"Alfredo",location_latitude:48.860819,location_longitude:2.354507,map_image_url:"img/thumb_map_international_1.jpg",name_point:"Alfredo",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"},{name:"Madlene Bar",location_latitude:48.853798,location_longitude:2.333328,map_image_url:"img/thumb_map_international_2.jpg",name_point:"Madlene Bar",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"},{name:"Spago Bistrot",location_latitude:48.85837,location_longitude:2.294481,map_image_url:"img/thumb_map_international_3.jpg",name_point:"Spago Bistrot",description_point:"Lorem Ipsum is simply dummy text of the printing and typesetting industry.",get_directions_start_address:"",phone:"+3934245255",url_point:"single_restaurant.html"}]},mapOptions={zoom:13,center:new google.maps.LatLng(48.865633,2.321236),mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:!1,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU,position:google.maps.ControlPosition.LEFT_CENTER},panControl:!1,panControlOptions:{position:google.maps.ControlPosition.TOP_RIGHT},zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.LARGE,position:google.maps.ControlPosition.RIGHT_BOTTOM},scrollwheel:!1,scaleControl:!1,scaleControlOptions:{position:google.maps.ControlPosition.LEFT_CENTER},streetViewControl:!0,streetViewControlOptions:{position:google.maps.ControlPosition.RIGHT_BOTTOM},styles:[{featureType:"administrative.country",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"administrative.province",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"administrative.locality",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"administrative.land_parcel",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"landscape.man_made",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"landscape.natural.landcover",elementType:"all",stylers:[{visibility:"on"}]},{featureType:"landscape.natural.terrain",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.attraction",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.business",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.government",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.medical",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.park",elementType:"all",stylers:[{visibility:"on"}]},{featureType:"poi.park",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"poi.place_of_worship",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.school",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"poi.sports_complex",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.highway",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.highway",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"road.highway.controlled_access",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.arterial",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"transit.line",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit.station.airport",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit.station.bus",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit.station.rail",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"off"}]}]};for(var key in mapObject=new google.maps.Map(document.getElementById("map"),mapOptions),markersData)markersData[key].forEach(function(e){marker=new google.maps.Marker({position:new google.maps.LatLng(e.location_latitude,e.location_longitude),map:mapObject,icon:"img/pins/"+key+".png"}),void 0===markers[key]&&(markers[key]=[]),markers[key].push(marker),google.maps.event.addListener(marker,"click",function(){closeInfoBox(),getInfoBox(e).open(mapObject,this),mapObject.setCenter(new google.maps.LatLng(e.location_latitude,e.location_longitude))})});function hideAllMarkers(){for(var e in markers)markers[e].forEach(function(e){e.setMap(null)})}function toggleMarkers(e){if(hideAllMarkers(),closeInfoBox(),void 0===markers[e])return!1;markers[e].forEach(function(e){e.setMap(mapObject),e.setAnimation(google.maps.Animation.DROP)})}function closeInfoBox(){$("div.infoBox").remove()}function getInfoBox(e){return new InfoBox({content:'<div class="marker_info_2"><img src="'+e.map_image_url+'" alt="Image"/><h3>'+e.name_point+"</h3><span>"+e.description_point+'</span><div class="marker_tools"><form action="https://maps.google.com/maps" method="get" target="_blank" style="display:inline-block""><input name="saddr" value="'+e.get_directions_start_address+'" type="hidden"><input type="hidden" name="daddr" value="'+e.location_latitude+","+e.location_longitude+'"><button type="submit" value="Get directions" class="btn_infobox_get_directions">Directions</button></form><a href="tel://'+e.phone+'" class="btn_infobox_phone">'+e.phone+'</a></div><a href="'+e.url_point+'" class="btn_infobox">Details</a></div>',disableAutoPan:!1,maxWidth:0,pixelOffset:new google.maps.Size(10,125),closeBoxMargin:"5px -20px 2px 2px",closeBoxURL:"img/close_infobox.png",isHidden:!1,alignBottom:!0,pane:"floatPane",enableEventPropagation:!0})}function onHtmlClick(e,t){google.maps.event.trigger(markers[e][t],"click")}