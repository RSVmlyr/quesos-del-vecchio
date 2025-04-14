import { addClickEventListener } from '../utils/listeners';
import { Loader } from '@googlemaps/js-api-loader';

const CLASSNAMES = {
  CONTAINER: '.locations',
  BUTTON_GRID: '.locations__button--grid',
  BUTTON_MAP: '.locations__button--map',
  GRID: '.locations__grid',
  MAP: '.locations__map',
  MAP_CONTAINER: '.locations__google-map',
  LOCATIONS: '.locations__google-map-location',
};

const loader = new Loader({
  apiKey: window.googleMapsApiKey,
  version: 'weekly',
  libraries: ['maps', 'marker'],
});

const mapStyles = [
  {
    featureType: 'all',
    elementType: 'labels.text.fill',
    stylers: [
      {
        saturation: 36,
      },
      {
        color: '#333333',
      },
      {
        lightness: 40,
      },
    ],
  },
  {
    featureType: 'all',
    elementType: 'labels.text.stroke',
    stylers: [
      {
        visibility: 'on',
      },
      {
        color: '#ffffff',
      },
      {
        lightness: 16,
      },
    ],
  },
  {
    featureType: 'all',
    elementType: 'labels.icon',
    stylers: [
      {
        visibility: 'off',
      },
    ],
  },
  {
    featureType: 'administrative',
    elementType: 'geometry.fill',
    stylers: [
      {
        lightness: 20,
      },
    ],
  },
  {
    featureType: 'administrative',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#fefefe',
      },
      {
        lightness: 17,
      },
      {
        weight: 1.2,
      },
    ],
  },
  {
    featureType: 'landscape',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f5eedd',
      },
      {
        lightness: 20,
      },
    ],
  },
  {
    featureType: 'poi',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f5eedd',
      },
      {
        lightness: 21,
      },
    ],
  },
  {
    featureType: 'poi.park',
    elementType: 'geometry',
    stylers: [
      {
        color: '#e2d2b9',
      },
      {
        lightness: 21,
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'geometry.fill',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 17,
      },
    ],
  },
  {
    featureType: 'road.highway',
    elementType: 'geometry.stroke',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 29,
      },
      {
        weight: 0.2,
      },
    ],
  },
  {
    featureType: 'road.arterial',
    elementType: 'geometry',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 18,
      },
    ],
  },
  {
    featureType: 'road.local',
    elementType: 'geometry',
    stylers: [
      {
        color: '#ffffff',
      },
      {
        lightness: 16,
      },
    ],
  },
  {
    featureType: 'transit',
    elementType: 'geometry',
    stylers: [
      {
        color: '#f2f2f2',
      },
      {
        lightness: 19,
      },
    ],
  },
  {
    featureType: 'transit.station.rail',
    elementType: 'all',
    stylers: [
      {
        visibility: 'on',
      },
    ],
  },
  {
    featureType: 'transit.station.rail',
    elementType: 'labels.icon',
    stylers: [
      {
        hue: '#ff7800',
      },
      {
        saturation: '-10',
      },
    ],
  },
  {
    featureType: 'water',
    elementType: 'geometry',
    stylers: [
      {
        color: '#e2d2b9',
      },
      {
        lightness: 17,
      },
    ],
  },
];

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

    this.loadGoogleMaps().then(() => this.initMap());
  }

  loadGoogleMaps() {
    return loader.importLibrary('maps');
  }

  async initMap() {
    if (!this.mapContainer) return;

    const locations = this.getLocations();
    if (locations.length === 0) return;

    // Calculate bounds to fit all markers
    const bounds = new google.maps.LatLngBounds();
    locations.forEach((location) => {
      bounds.extend(location.position);
    });

    const map = new google.maps.Map(this.mapContainer, {
      mapId: window.googleMapsIdMap,
      styles: mapStyles,
    });

    // Fit map to bounds
    map.fitBounds(bounds);

    const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary('marker');

    const markers = locations.map((location) => {
      const pin = new PinElement({
        background: '#23195F', // Blue color from your theme
        borderColor: '#ffffff',
        glyphColor: '#ffffff',
        scale: 1.2,
      });

      const marker = new AdvancedMarkerElement({
        map,
        position: location.position,
        title: location.name,
        content: pin.element,
      });

      // Create info window
      const infoWindow = new google.maps.InfoWindow({
        content: `
          <div class="bg-white">
            <h3 class="text-blue font-semibold text-lg mb-2">${location.name}</h3>
            <p class="text-blue text-sm">${location.address || ''}</p>
            <p class="text-blue text-sm">${location.schedule || ''}</p>
          </div>
        `,
        disableAutoPan: true,
        pixelOffset: new google.maps.Size(0, -30),
      });

      // Add click listener to marker
      marker.addListener('click', () => {
        infoWindow.open({
          anchor: marker,
          map,
        });
      });

      return marker;
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
        });
      }
    });

    return locations;
  }
}

export default Locations;
