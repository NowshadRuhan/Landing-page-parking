 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEFuGuND-pvzxnanuRGOVkuAChYK0h20s"></script>
<script>

     
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        zoom: 14,
        mapTypeId: 'roadmap',
        styles: [
                {
                  "featureType": "administrative",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#d6e2e6"
                    }
                  ]
                },
                {
                  "featureType": "administrative",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#cfd4d5"
                    }
                  ]
                },
                {
                  "featureType": "administrative",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#7492a8"
                    }
                  ]
                },
                {
                  "featureType": "administrative.neighborhood",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "lightness": 25
                    }
                  ]
                },
                {
                  "featureType": "landscape.man_made",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#dde2e3"
                    }
                  ]
                },
                {
                  "featureType": "landscape.man_made",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#cfd4d5"
                    }
                  ]
                },
                {
                  "featureType": "landscape.natural",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#dde2e3"
                    }
                  ]
                },
                {
                  "featureType": "landscape.natural",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#7492a8"
                    }
                  ]
                },
                {
                  "featureType": "landscape.natural.terrain",
                  "elementType": "all",
                  "stylers": [
                    {
                      "visibility": "off"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#dde2e3"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#588ca4"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "labels.icon",
                  "stylers": [
                    {
                      "saturation": -100
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#a9de83"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#bae6a1"
                    }
                  ]
                },
                {
                  "featureType": "poi.sports_complex",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#c6e8b3"
                    }
                  ]
                },
                {
                  "featureType": "poi.sports_complex",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#bae6a1"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#41626b"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "labels.icon",
                  "stylers": [
                    {
                      "saturation": -45
                    },
                    {
                      "lightness": 10
                    },
                    {
                      "visibility": "on"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#c1d1d6"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#a6b5bb"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "labels.icon",
                  "stylers": [
                    {
                      "visibility": "on"
                    }
                  ]
                },
                {
                  "featureType": "road.highway.controlled_access",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#9fb6bd"
                    }
                  ]
                },
                {
                  "featureType": "road.arterial",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#ffffff"
                    }
                  ]
                },
                {
                  "featureType": "road.local",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#ffffff"
                    }
                  ]
                },
                {
                  "featureType": "transit",
                  "elementType": "labels.icon",
                  "stylers": [
                    {
                      "saturation": -70
                    }
                  ]
                },
                {
                  "featureType": "transit.line",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#b4cbd4"
                    }
                  ]
                },
                {
                  "featureType": "transit.line",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#588ca4"
                    }
                  ]
                },
                {
                  "featureType": "transit.station",
                  "elementType": "all",
                  "stylers": [
                    {
                      "visibility": "off"
                    }
                  ]
                },
                {
                  "featureType": "transit.station",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#008cb5"
                    },
                    {
                      "visibility": "on"
                    }
                  ]
                },
                {
                  "featureType": "transit.station.airport",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "saturation": -100
                    },
                    {
                      "lightness": -5
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#a6cbe3"
                    }
                  ]
                }
              ]


        };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    map.setTilt(50);


 

        
    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php if($all_places){

            foreach ($all_places as $all_place) {
                echo '["'.$all_place->lat.'", '.$all_place->lon.'],';
            }
        }
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($all_places2){

            foreach ($all_places2 as $all_place2) { ?>
              <?php 
                $name =  $all_place2->name;
                // $address = $all_place2->address;
                // $type = $all_place2->type;
                ?>


                ['<div class="info_content">' +
                  '<h4><?php echo $name; ?></h3>' +
                  '<h5><?php echo $all_place2->local; echo $all_place2->division; ?></h4>' +
                  '<h5><?php echo "Available Slot : "; echo $all_place2->ava_slot; ?></h5>' +
                  '<h6><?php echo "Total Slot : "; echo $all_place2->total_slot; ?></h6>' +
                  '<p><?php echo "Place Type : "; echo $all_place2->cost; ?></p>' + 
                  '<p style="margin-top:5px; font-size:14px;"><a style="margin-top:5px; font-size:14px;" href="" style="font-size: 16px;" >See More</a></p>'+
                '</div>'],
        <?php }
        }
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            icon: 'http://localhost/Parking_Koi_USA/resource/36.png',
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>



<div class="row" style="margin-left: 0px; margin-right: 0px; margin-top: 0px;">
        <div  style="width: 100%; height:100%;">

            <div id="container" class="map_div" >

              
                     
                    

                <div class="map1"   id="map"></div>
            </div>
             
        </div>
    </div>

