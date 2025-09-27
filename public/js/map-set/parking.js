/* Исходная точка */
var map = L.map('map').setView([38.56295, 68.7966], 17);
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
var greenIcon = L.icon({
    iconUrl: 'icon/cp.svg',
    iconSize: [40, 40],
    popupAnchor: [0, -25]
});
/* Первая точка */
var polygonContent = '<div class="satpp">' +
    '<p class="pop">Парковачная зона №3</p>' +
    '<txt class="po2">Ул. Мирзо Турсунзоде, 18/6</txt>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-credit-card" aria-hidden="true"></i>Стоимость в час</p><p class="lpo">1 сом</p></div>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-bolt" aria-hidden="true"></i></i>Зарядная станция</p><p class="lpo">Есть</p></div>' +
    '<div class="">Парковачных мест: 6</div>' +
    '</div>';
var marker1 = L.marker([38.56300, 68.79647], { icon: greenIcon })
    .bindPopup(polygonContent)
    .addTo(map)
    .on('click', function (e) {
        map.setView(e.target.getLatLng(), 18); // переместить карту на место клика
        e.target.openPopup(); // открыть попап
    });
var polygon = L.polygon([
    [38.56297, 68.79564],
    [38.56300, 68.79731]
], {
    fillColor: '#3388ff',
    fillOpacity: 0.3,
    color: '#3388ff',
    weight: 7
}).bindPopup(polygonContent);
var group = L.layerGroup([marker1, polygon]).addTo(map);
/* Далее */
var polygonContent = '<div class="satpp">' +
    '<p class="pop">Парковачная зона №3</p>' +
    '<txt class="po2">Ул. Мирзо Турсунзоде, 18/6</txt>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-credit-card" aria-hidden="true"></i>Стоимость в час</p><p class="lpo">1 сом</p></div>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-bolt" aria-hidden="true"></i></i>Зарядная станция</p><p class="lpo">Есть</p></div>' +
    '<div class="">Парковачных мест: 6</div>' +
    '</div>';
var marker2 = L.marker([38.56002, 68.79905], {icon: greenIcon})
    .bindPopup(polygonContent)
    .addTo(map)
    .on('click', function (e) {
        map.setView(e.target.getLatLng(), 18); // переместить карту на место клика
        e.target.openPopup(); // открыть попап
    });
var polygon = L.polygon([
    [38.56143, 68.79890],
    [38.55861, 68.79914]
], {
    fillColor: '#3388ff',
    fillOpacity: 0.3,
    color: '#3388ff',
    weight: 7
}).bindPopup(polygonContent);
var group = L.layerGroup([marker2, polygon]).addTo(map);
/* Далее */
var polygonContent = '<div class="satpp">' +
    '<p class="pop">Парковачная зона №3</p>' +
    '<txt class="po2">Ул. Мирзо Турсунзоде, 18/6</txt>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-credit-card" aria-hidden="true"></i>Стоимость в час</p><p class="lpo">1 сом</p></div>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-bolt" aria-hidden="true"></i></i>Зарядная станция</p><p class="lpo">Есть</p></div>' +
    '<div class="">Парковачных мест: 6</div>' +
    '</div>';
var marker3 = L.marker([38.56002, 68.79975], { icon: greenIcon })
    .bindPopup(polygonContent)
    .addTo(map)
    .on('click', function (e) {
        map.setView(e.target.getLatLng(), 18); // переместить карту на место клика
        e.target.openPopup(); // открыть попап
    });
var polygon = L.polygon([
    [38.56143, 68.79960],
    [38.55861, 68.79984]
], {
    fillColor: '#3388ff',
    fillOpacity: 0.3,
    color: '#3388ff',
    weight: 7
}).bindPopup(polygonContent);
var group = L.layerGroup([marker3, polygon]).addTo(map);
/* Далее */
var polygonContent = '<div class="satpp">' +
    '<p class="pop">Парковачная зона №3</p>' +
    '<txt class="po2">Ул. Мирзо Турсунзоде, 18/6</txt>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-credit-card" aria-hidden="true"></i>Стоимость в час</p><p class="lpo">1 сом</p></div>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-bolt" aria-hidden="true"></i></i>Зарядная станция</p><p class="lpo">Есть</p></div>' +
    '<div class="">Парковачных мест: 6</div>' +
    '</div>';
var marker4 = L.marker([38.55949, 68.79473], { icon: greenIcon })
    .bindPopup(polygonContent)
    .addTo(map)
    .on('click', function (e) {
        map.setView(e.target.getLatLng(), 18); // переместить карту на место клика
        e.target.openPopup(); // открыть попап
    });
var polygon = L.polygon([
    [38.56282, 68.79435],
    [38.56122, 68.79453]
], {
    fillColor: '#3388ff',
    fillOpacity: 0.3,
    color: '#3388ff',
    weight: 7
}).bindPopup(polygonContent);
var group = L.layerGroup([marker4, polygon]).addTo(map);
/* Далее */
var polygonContent = '<div class="satpp">' +
    '<p class="pop">Парковачная зона №3</p>' +
    '<txt class="po2">Ул. Мирзо Турсунзоде, 18/6</txt>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-credit-card" aria-hidden="true"></i>Стоимость в час</p><p class="lpo">1 сом</p></div>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-bolt" aria-hidden="true"></i></i>Зарядная станция</p><p class="lpo">Есть</p></div>' +
    '<div class="">Парковачных мест: 6</div>' +
    '</div>';
var marker5 = L.marker([38.56202, 68.79443], { icon: greenIcon })
    .bindPopup(polygonContent)
    .addTo(map)
    .on('click', function (e) {
        map.setView(e.target.getLatLng(), 18); // переместить карту на место клика
        e.target.openPopup(); // открыть попап
    });
var polygon = L.polygon([
    [38.56075, 68.79461],
    [38.55794, 68.79488]
], {
    fillColor: '#3388ff',
    fillOpacity: 0.3,
    color: '#3388ff',
    weight: 7
}).bindPopup(polygonContent);
var group = L.layerGroup([marker5, polygon]).addTo(map);
/* Далее */
var polygonContent = '<div class="satpp">' +
    '<p class="pop">Парковачная зона №3</p>' +
    '<txt class="po2">Ул. Мирзо Турсунзоде, 18/6</txt>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-credit-card" aria-hidden="true"></i>Стоимость в час</p><p class="lpo">1 сом</p></div>' +
    '<div class="cl-tt"><p class="opl"><i class="fa fa-bolt" aria-hidden="true"></i></i>Зарядная станция</p><p class="lpo">Есть</p></div>' +
    '<div class="">Парковачных мест: 6</div>' +
    '</div>';
var marker6 = L.marker([38.55817, 68.79753], { icon: greenIcon })
    .bindPopup(polygonContent)
    .addTo(map)
    .on('click', function (e) {
        map.setView(e.target.getLatLng(), 18); // переместить карту на место клика
        e.target.openPopup(); // открыть попап
    });
var polygon = L.polygon([
    [38.55827, 68.79893],
    [38.55807, 68.79633]
], {
    fillColor: '#3388ff',
    fillOpacity: 0.3,
    color: '#3388ff',
    weight: 7
}).bindPopup(polygonContent);
var group = L.layerGroup([marker6, polygon]).addTo(map);
/* Добавляем поиск по местонахождению */
// Создаем объект иконки
var customIcon = L.icon({
    iconUrl: 'icon/YourPasition.svg',
    iconSize: [38, 38],
    iconAnchor: [19, 19],
    popupAnchor: [0, -19]
});
// Локализация
map.locate({ setView: true, maxZoom: 17 });
function onLocationFound(e) {
    var radius = e.accuracy;
    radius = Math.min(radius, 99); // ограничиваем радиус до 99 метров
    radius = Math.round(radius); // округляем радиус до ближайшего целого числа

    // Используем созданную иконку
    L.marker(e.latlng, { icon: customIcon }).addTo(map)
        .bindPopup("Вы находитесь в " + radius + " метрах от этой точки").openPopup();
}
function onLocationError(e) {
    alert(e.message);
}
map.on('locationfound', onLocationFound);
map.on('locationerror', onLocationError);