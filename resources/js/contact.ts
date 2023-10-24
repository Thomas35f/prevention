import * as L from 'leaflet';

const map: L.Map = L.map('map').setView([48.1139744, -1.6028991], 16);
const marker: L.Marker = L.marker([48.1139744, -1.6028991]).addTo(map);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 19
}).addTo(map);
