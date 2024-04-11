<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mapbox Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
    <style>
        body { margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
        #mapContainer { display: none; position: relative; width: 80%; height: 400px; margin: 0 auto; }
        #map { position: absolute; top: 0; bottom: 0; left: 0; right: 0; }
    </style>
</head>
<body>
    <button id="showMapButton">Show Map</button>
    <button id="closeMapButton" style="display: none;">Close Map</button>
    <div id="mapContainer">
        <div id="map"></div>
    </div>
    <script>
        // Add your Mapbox access token here
        mapboxgl.accessToken = 'pk.eyJ1IjoiY2hpbm1veS0wMTciLCJhIjoiY2x1anhuMmZwMGxlYTJqcGh3dXlvMXQzbyJ9.h5LoIrYtd9Dhy2W3PWTVcw';

        // Function to geocode the location text and add a marker
        function geocodeAndAddMarker(locationText) {
            fetch('https://api.mapbox.com/geocoding/v5/mapbox.places/' + encodeURIComponent(locationText) + '.json?access_token=' + mapboxgl.accessToken)
                .then(response => response.json())
                .then(data => {
                    const coordinates = data.features[0].center;
                    // Initialize map
                    const map = new mapboxgl.Map({
                        container: 'map', // Container ID
                        style: 'mapbox://styles/mapbox/streets-v12', // Map style URL
                        center: coordinates, // Center coordinates
                        zoom: 9 // Zoom level
                    });
                    // Add marker to the map
                    new mapboxgl.Marker().setLngLat(coordinates).addTo(map).setPopup(new mapboxgl.Popup().setHTML(<h3>${locationText}</h3>));
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Event listener for showing the map
        const showMapButton = document.getElementById('showMapButton');
        const closeMapButton = document.getElementById('closeMapButton');

        showMapButton.addEventListener('click', () => {
            document.getElementById('mapContainer').style.display = 'block';
            geocodeAndAddMarker(locationFromDatabase.address); // Load location from the database
            showMapButton.style.display = 'none'; // Hide the "Show Map" button
            closeMapButton.style.display = 'block'; // Show the "Close Map" button
        });

        // Event listener for closing the map
        closeMapButton.addEventListener('click', () => {
            document.getElementById('mapContainer').style.display = 'none';
            showMapButton.style.display = 'block'; // Show the "Show Map" button
            closeMapButton.style.display = 'none'; // Hide the "Close Map" button
        });

        // Load a single location from the database
        const locationFromDatabase = {
            name: 'Mumbai',
            address: 'Delhi, India'
            // You can change the name and address as needed
        };
    </script>
</body>
</html>