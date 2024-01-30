@extends('layouts.header')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <!-- Include the Leaflet JavaScript file -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <div id="map" style="height: 800px;width:100%;"></div>
    <script>
            const uluru = [
                @php
                foreach($coachings as $coaching){
                    if($coaching->latitude && $coaching->latitude != "N/A"  && $coaching->latitude != "" ){
                        $contentString = 
                            '<div id="content">'.
                            '<div id="siteNotice">'.
                            "</div>".
                            '<img style="heigth:120px;width:120px;object-fit:contain;" src='.url('storage').'/'.$coaching->logo.'>'.
                            '<h1 id="firstHeading" class="firstHeading">'.addcslashes($coaching->name,"'").'</h1>'.
                            '<div id="bodyContent">'.
                            "<ul>".
                                "<li>Ratings: 4.2</li>".
                                "<li>Courses: ".$coaching->mainCourse->name."</li>".                            
                                "<li>Phone: ".$coaching->phone."</li>".
                                // "<li>Address: ".$coaching->address."</li>".
                                "<li>State: ".$coaching->state."</li>".
                            "</ul>".
                            "</div>" .
                            "</div>";

                            echo "[{ lat: parseFloat(".$coaching->latitude."), lng: parseFloat(".$coaching->longitude.") },'".addcslashes($coaching->name,"'")."','".$coaching->logo."','".$contentString."'],";
                        }
                    }
                @endphp
            ]
           

            var map = L.map('map').setView([uluru[0][0].lat, uluru[0][0].lng], 13);

            // Add a tile layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
                maxZoom: 18
            }).addTo(map);

            // Define an array of marker locations
            var markers = [
                [51.5, -0.09],
                [51.51, -0.1],
                [51.52, -0.11]
            ];

            // Loop through the markers array and add a marker for each location
            for (var i = 0; i < uluru.length; i++) {
                var marker = uluru[i][0];
                var popupContent = uluru[i][3];
                L.marker(marker).bindPopup(popupContent).addTo(map);
            }
    </script>
@endsection