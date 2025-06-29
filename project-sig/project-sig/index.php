<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Choropleth Lansia Banyumas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map { height: 600px; }
    .info {
      padding: 6px 8px;
      background: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      border-radius: 5px;
    }
    .legend {
      background: white;
      padding: 6px 8px;
      line-height: 18px;
      color: #555;
    }
    .legend i {
      width: 18px;
      height: 18px;
      float: left;
      margin-right: 8px;
      opacity: 0.7;
    }
  </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="data/kecamatan.js"></script>

<script>
  const map = L.map('map').setView([-7.5, 109.25], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18
  }).addTo(map);

  const dataLansia = {
    "AJIBARANG": 8712,
    "BANYUMAS": 2355,
    "BATURRADEN": 5263,
    "CILONGOK": 9125,
    "GUMELAR": 7243,
    "JATILAWANG": 11888,
    "KALIBAGOR": 8067,
    "KARANGLEWAS": 6930,
    "KEBASEN": 6962,
    "KEDUNGBANTENG": 8595,
    "KEMBARAN": 5647,
    "KEMRANJEN": 4116,
    "LUMBIR": 7534,
    "PATIKRAJA": 9656,
    "PEKUNCEN": 8290,
    "PURWOJATI": 2801,
    "PURWOKERTO BARAT": 7840,
    "PURWOKERTO SELATAN": 6417,
    "PURWOKERTO TIMUR": 6956,
    "PURWOKERTO UTARA": 5324,
    "RAWALO": 7909,
    "SOKARAJA": 6002,
    "SOMAGEDE": 5967,
    "SUMBANG": 9343,
    "SUMPIUH": 3277,
    "TAMBAK": 4736,
    "WANGON": 9179
  };

  function normalizeNama(nama) {
    return (nama || '').replace(/\s+/g, '').toUpperCase();
  }

  function getColor(d) {
    return d > 10000 ? '#800026' :
           d > 8000  ? '#BD0026' :
           d > 6000  ? '#E31A1C' :
           d > 4000  ? '#FC4E2A' :
           d > 2000  ? '#FD8D3C' :
                       '#FEB24C';
  }

  function style(feature) {
    const rawNama = feature.properties.Name;
    const nama = normalizeNama(rawNama);
    const value = dataLansia[nama] || 0;

    if (!dataLansia[nama]) {
      console.warn("❗ Tidak cocok:", rawNama, "→ jadi:", nama);
    }

    return {
      fillColor: getColor(value),
      weight: 2,
      opacity: 1,
      color: 'white',
      dashArray: '3',
      fillOpacity: 0.7
    };
  }

  function highlightFeature(e) {
    const layer = e.target;
    layer.setStyle({
      weight: 3,
      color: '#666',
      dashArray: '',
      fillOpacity: 0.7
    });
    layer.bringToFront();
    info.update(layer.feature.properties);
  }

  function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
  }

  function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
  }

  function onEachFeature(feature, layer) {
    const rawNama = feature.properties.Name;
    const nama = normalizeNama(rawNama);
    const jumlah = dataLansia[nama] || "Tidak ada data";
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature
    });
    layer.bindPopup("<b>" + rawNama + "</b><br>Lansia: " + jumlah);
  }

  const info = L.control();

  info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
  };

  info.update = function (props) {
    const rawNama = props && props.Name ? props.Name : '';
    const nama = normalizeNama(rawNama);
    const jumlah = dataLansia[nama] || '';
    this._div.innerHTML = '<h4>Jumlah Lansia</h4>' + (props ?
      '<b>' + rawNama + '</b><br />' + jumlah + ' orang'
      : 'Arahkan ke kecamatan');
  };

  info.addTo(map);

  const legend = L.control({position: 'bottomright'});

  legend.onAdd = function (map) {
    const div = L.DomUtil.create('div', 'legend'),
      grades = [0, 2000, 4000, 6000, 8000, 10000];

    for (let i = 0; i < grades.length; i++) {
      div.innerHTML +=
        '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
        grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
    }

    return div;
  };

  legend.addTo(map);

  let geojson = L.geoJson(kecamatan, {
    style: style,
    onEachFeature: onEachFeature
  }).addTo(map);
</script>
</body>
</html>
