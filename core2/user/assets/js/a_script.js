mapboxgl.accessToken =
  "pk.eyJ1IjoiYWNybjA2MTIiLCJhIjoiY2t2eXQ5dmtpMHZuMTJvcGF5NHd5dXp0ZiJ9.tfacZedcwMzTJdqG4wL1IA"

navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
  enableHighAccuracy: true
})

function successLocation(position) {
  setupMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation() {
  setupMap([121.0450, 14.7566])
}

function setupMap(center) {
  const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/mapbox/streets-v11",
    center: center,
    zoom: 14
  })

  const nav = new mapboxgl.NavigationControl()
  map.addControl(nav)

  var directions = new MapboxDirections({
    accessToken: mapboxgl.accessToken,
    unit: 'metric',
    profile: 'mapbox/driving'
  })

  map.addControl(directions, "top-left")
}