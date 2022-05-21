mapboxgl.accessToken =
  "pk.eyJ1IjoiamF6emZ1bmsiLCJhIjoiY2wwemV5eDRqMW5rcDNva2I0ODJwMHNnbSJ9.NEfY42UG60eVjEbtzHoptg"

navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
  enableHighAccuracy: true
})

function successLocation(position) {
  setupMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation() {
  setupMap([121.0437, 14.6760])
}

function setupMap(center) {
  const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/mapbox/streets-v11",
    center: center,
    zoom: 15
  })

  // Create a new marker.
  const marker = new mapboxgl.Marker()
    .setLngLat(center)
    .addTo(map);

  const nav = new mapboxgl.NavigationControl();
  map.addControl(nav);

  mapboxgl.accessToken = mapboxgl.accessToken;

  // an arbitrary start will always be the same
  // only the end or destination will change
  const start = center;
  // create a function to make a directions request
  async function getRoute(end) {

    // make a directions request using cycling profile
    // an arbitrary start will always be the same
    // only the end or destination will change
    const query = await fetch(
      `https://api.mapbox.com/directions/v5/mapbox/driving-traffic/${start[0]},${start[1]};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`,
      { method: 'GET' }
    );
    const json = await query.json();
    const data = json.routes[0];
    const route = data.geometry.coordinates;
    const geojson = {
      type: 'Feature',
      properties: {},
      geometry: {
        type: 'LineString',
        coordinates: route
      }
    };

    window.destination_coor = end;
    window.distance = data.distance;
    window.duration = data.duration;

    // if the route already exists on the map, we'll reset it using setData
    if (map.getSource('route')) {
      map.getSource('route').setData(geojson);
    }
    // otherwise, we'll make a new request
    else {
      map.addLayer({
        id: 'route',
        type: 'line',
        source: {
          type: 'geojson',
          data: geojson
        },
        layout: {
          'line-join': 'round',
          'line-cap': 'round'
        },
        paint: {
          'line-color': '#3887be',
          'line-width': 5,
          'line-opacity': 0.75
        }
      });
    }
    // add turn instructions here at the end
  }

  map.on('load', () => {
    // make an initial directions request that
    // starts and ends at the same location
    // getRoute(start);

    // Add starting point to the map
    // map.addLayer({
    //   id: 'point',
    //   type: 'circle',
    //   source: {
    //     type: 'geojson',
    //     data: {
    //       type: 'FeatureCollection',
    //       features: [
    //         {
    //           type: 'Feature',
    //           properties: {},
    //           geometry: {
    //             type: 'Point',
    //             coordinates: start
    //           }
    //         }
    //       ]
    //     }
    //   },
    //   paint: {
    //     'circle-radius': 10,
    //     'circle-color': '#3887be'
    //   }
    // });

    // // markers saved here
    // var currentMarkers = [];

    map.on('click', (event) => {
      const coords = Object.keys(event.lngLat).map((key) => event.lngLat[key]);

      // // tmp marker
      // const oneMarker = new mapboxgl.Marker()
      //   .setLngLat(coords)
      //   .addTo(map);

      // // save tmp marker into currentMarkers
      // currentMarkers.push(oneMarker);

      // // remove markers 
      // if (currentMarkers.length == 2) {
      //   currentMarkers[0].remove();
      //   currentMarkers.shift();
      // }

      const end = {
        type: 'FeatureCollection',
        features: [
          {
            type: 'Feature',
            properties: {},
            geometry: {
              type: 'Point',
              coordinates: coords
            }
          }
        ]
      };

      if (map.getLayer('end')) {
        map.getSource('end').setData(end);
      } else {
        map.addLayer({
          id: 'end',
          type: 'circle',
          source: {
            type: 'geojson',
            data: {
              type: 'FeatureCollection',
              features: [
                {
                  type: 'Feature',
                  properties: {},
                  geometry: {
                    type: 'Point',
                    coordinates: coords
                  }
                }
              ]
            }
          },
          paint: {
            'circle-radius': 10,
            'circle-color': '#f30'
          }
        });
      }
      getRoute(coords);
    });
  });

  const geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl
  });

  map.addControl(geocoder, "bottom-left");

  geocoder.on('result', (event) => {
    const destination_coordinates = Object.keys(geocoder.mapMarker._lngLat).map((key) => geocoder.mapMarker._lngLat[key]);
    // if (map.getLayer('end')) {
    //   map.removeLayer('end');
    // }
    // oneMarker.remove();
    // console.log(destination_coordinates);
    getRoute(destination_coordinates);
  });

  document.getElementById("click_button").addEventListener("click", function click_button() {
    distance = window.distance / 1000;
    duration = window.duration / 60;
    async function getDestinationName() {
      const query = await fetch(
        `https://api.mapbox.com/geocoding/v5/mapbox.places/${window.destination_coor[0]},${window.destination_coor[1]}.json?access_token=pk.eyJ1IjoiamF6emZ1bmsiLCJhIjoiY2wwemV5eDRqMW5rcDNva2I0ODJwMHNnbSJ9.NEfY42UG60eVjEbtzHoptg`,
        { method: 'GET' }
      );
      const json = await query.json();
      // console.log(window.destination_coor);
      // console.log(json.features[0]);

      location.href = "next_page.php?distance=" + distance + "&duration=" + duration + "&destination=" + json.features[0].text + "&destination_address=" + json.features[0].properties.address;
    }
    getDestinationName();
  });

}
