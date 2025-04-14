// Load Google Maps API
function loadGoogleMaps() {
  return new Promise((resolve, reject) => {
    if (window.google && window.google.maps) {
      resolve(window.google.maps);
      return;
    }

    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap`;
    script.async = true;
    script.defer = true;
    script.onerror = () => reject(new Error('Failed to load Google Maps'));
    document.head.appendChild(script);

    window.initMap = () => {
      resolve(window.google.maps);
    };
  });
}

// Initialize map
async function initLocationsMap() {
  try {
    const googleMaps = await loadGoogleMaps();
    const mapElement = document.querySelector('.locations__map');

    if (!mapElement) return;

    // Get all location elements
    const locationElements = document.querySelectorAll('.locations__map > div > div > div');
    const locations = Array.from(locationElements).map((element) => {
      const title = element.querySelector('h3').textContent;
      const address = element.querySelector('p:first-of-type').textContent;
      return { element, title, address };
    });

    // Create map instance
    const map = new googleMaps.Map(mapElement, {
      center: { lat: -34.397, lng: 150.644 }, // Default center, you should update this
      zoom: 8,
      styles: [
        {
          featureType: 'poi',
          elementType: 'labels',
          stylers: [{ visibility: 'off' }],
        },
      ],
    });

    // Create markers for each location
    const markers = locations.map((location) => {
      // You'll need to geocode the address to get lat/lng
      // For now, using a placeholder
      const marker = new googleMaps.Marker({
        position: { lat: -34.397, lng: 150.644 }, // Replace with actual coordinates
        map: map,
        title: location.title,
      });

      // Add click event to scroll to location
      marker.addListener('click', () => {
        location.element.scrollIntoView({ behavior: 'smooth' });
      });

      return marker;
    });

    // Fit map to show all markers
    if (markers.length > 0) {
      const bounds = new googleMaps.LatLngBounds();
      markers.forEach((marker) => bounds.extend(marker.getPosition()));
      map.fitBounds(bounds);
    }
  } catch (error) {
    console.error('Error initializing Google Maps:', error);
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  initLocationsMap();
});
