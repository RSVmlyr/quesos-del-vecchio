import { addClickEventListener } from '../utils/listeners';
import L from 'leaflet';

const CLASSNAMES = {
  CONTAINER: '.locations',
  BUTTON_GRID: '.locations__button--grid',
  BUTTON_MAP: '.locations__button--map',
  GRID: '.locations__grid',
  MAP: '.locations__map',
  MAP_CONTAINER: '.locations__google-map',
  LOCATIONS: '.locations__google-map-location',
};

class Locations {
  constructor(app, container) {
    this.app = app;
    this.container = container;

    this.buttonGrid = container.querySelector(CLASSNAMES.BUTTON_GRID);
    this.buttonMap = container.querySelector(CLASSNAMES.BUTTON_MAP);
    this.grid = container.querySelector(CLASSNAMES.GRID);
    this.map = container.querySelector(CLASSNAMES.MAP);
    this.mapContainer = container.querySelector(CLASSNAMES.MAP_CONTAINER);
    this.locations = container.querySelectorAll(CLASSNAMES.LOCATIONS);

    addClickEventListener(this.buttonGrid, this.toggleGrid.bind(this));
    addClickEventListener(this.buttonMap, this.toggleMap.bind(this));

    this.initMap();
  }

  initMap() {
    if (!this.mapContainer) return;

    const locations = this.getLocations();
    if (locations.length === 0) return;

    // Initialize the map
    const map = L.map(this.mapContainer, {
      zoomControl: false,
      attributionControl: false,
    });

    // Add tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    // Calculate bounds to fit all markers
    const bounds = L.latLngBounds();
    locations.forEach((location) => {
      bounds.extend([location.position.lat, location.position.lng]);
    });

    // Fit map to bounds with proper padding and ensure all markers are visible
    map.fitBounds(bounds, {
      padding: [30, 30],
      maxZoom: 15,
      animate: false,
    });

    // If there's only one location, set a reasonable zoom level
    if (locations.length === 1) {
      map.setView([locations[0].position.lat, locations[0].position.lng], 13);
    }

    // Create custom icon for markers
    const customIcon = L.divIcon({
      className: 'custom-marker',
      html: `
        <div style="
          width: 24px;
          height: 24px;
          background-color: #23195F;
          border: 2px solid #ffffff;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        ">
          <div style="
            width: 8px;
            height: 8px;
            background-color: #ffffff;
            border-radius: 50%;
          "></div>
        </div>
      `,
      iconSize: [24, 24],
      iconAnchor: [12, 12],
    });

    // Add markers for each location
    const markers = locations.map((location) => {
      const marker = L.marker([location.position.lat, location.position.lng], {
        icon: customIcon,
        title: location.name,
      }).addTo(map);

      // Create popup content
      const popupContent = `
        <div style="
          background: white;
          padding: 12px;
          border-radius: 8px;
          min-width: 200px;
          font-family: inherit;
        ">
          <h3 style="
            color: #23195F;
            font-weight: 600;
            font-size: 16px;
            margin: 0 0 8px 0;
            line-height: 1.2;
          ">${location.name}</h3>
          ${
            location.address
              ? `<p style="
            color: #23195F;
            font-size: 14px;
            margin: 0 0 4px 0;
            line-height: 1.3;
          ">${location.address}</p>`
              : ''
          }
          ${
            location.schedule
              ? `<p style="
            color: #23195F;
            font-size: 14px;
            margin: 0;
            line-height: 1.3;
          ">${location.schedule}</p>`
              : ''
          }
        </div>
      `;

      // Add popup to marker
      marker.bindPopup(popupContent, {
        closeButton: false,
        className: 'custom-popup',
      });

      return marker;
    });

    // Store map reference for potential future use
    this.leafletMap = map;
    this.markers = markers;

    // Ensure proper centering after map is fully loaded
    map.whenReady(() => {
      const currentBounds = L.latLngBounds();
      locations.forEach((location) => {
        currentBounds.extend([location.position.lat, location.position.lng]);
      });

      map.fitBounds(currentBounds, {
        padding: [30, 30],
        maxZoom: 15,
        animate: false,
      });
    });
  }

  toggleGrid() {
    this.buttonGrid.classList.add('locations__button--active');
    this.buttonMap.classList.remove('locations__button--active');
    this.grid.classList.add('locations__grid--active');
    this.map.classList.remove('locations__map--active');
  }

  toggleMap() {
    this.buttonGrid.classList.remove('locations__button--active');
    this.buttonMap.classList.add('locations__button--active');
    this.grid.classList.remove('locations__grid--active');
    this.map.classList.add('locations__map--active');

    // Invalidate map size when switching to map view to ensure proper rendering
    if (this.leafletMap) {
      setTimeout(() => {
        this.leafletMap.invalidateSize();

        // Re-center the map to show all markers after the map is properly rendered
        const locations = this.getLocations();
        if (locations.length > 0) {
          const bounds = L.latLngBounds();
          locations.forEach((location) => {
            bounds.extend([location.position.lat, location.position.lng]);
          });

          this.leafletMap.fitBounds(bounds, {
            padding: [30, 30],
            maxZoom: 15,
            animate: true,
          });
        }
      }, 150);
    }
  }

  getLocations() {
    const locations = [];

    this.locations.forEach((location) => {
      if (location.dataset.locationLat && location.dataset.locationLng) {
        locations.push({
          position: {
            lat: Number(location.dataset.locationLat),
            lng: Number(location.dataset.locationLng),
          },
          name: location.dataset.locationName,
          address: location.dataset.locationAddress,
          schedule: location.dataset.locationSchedule,
        });
      }
    });

    return locations;
  }
}

export default Locations;
