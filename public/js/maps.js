function drawInfoWindow(property) {
    var image = 'public/img/favicon.png';
    if (property.url_photos_habitation) {
        image = 'public/img/photos/habitats/grandes/'+property.url_photos_habitation
    }

    var title = 'N/A';
    if (property.titre_habitat) {
        title = property.titre_habitat
    }

    var address = 'lieu inconnu';
    if (property.adresse_habitat) {
        address = property.ville_habitat + ' ('+ property.code_postal_habitat +')'
    }

    var description = 'description non disponible';
    if (property.description_fr_habitat) {
        description = property.description_fr_habitat
    }

    var price = 'prix indisponible';
    if (property.prix_disponibilites) {
        price = property.prix_disponibilites
    }

    var ibContent = '';
    ibContent = '<div class="property-2" style="box-shadow:none;margin-bottom:0;">' +
                        '<!-- Property img -->' +
                        '<div class="property-img">' +
                            '<div class="featured">' + property.libelle_fr_types_bien + '</div>' +
                            '<div class="price-ratings">' +
                                '<div class="price"> ' + price + ' € / nuit</div>';
                                if(property.note != ""){
                                             ibContent += '<div class="ratings">';
                                                for(var i = 0; i < 5; i++){
                                                    if(property.note > i){
                                                        ibContent += '<i class="fa fa-star"></i>';
                                                    }else{
                                                         ibContent += '<i class="fa fa-star-o"></i>';
                                                    }
                                                }
                                             ibContent += '</div>';
                                }
                                 ibContent += '<div class="ratings">' +
                                '</div>' +
                            '</div>' +
                            '<img src="' + image + '" alt="rp" class="img-responsive">' +
                        '</div>' +
                        '<!-- content -->' +
                        '<div class="content">' +
                            '<!-- title -->' +
                            '<h4 class="title">' +
                                '<a href="habitat/' + property.id_habitat + '">' + title + '</a>' +
                            '</h4>' +
                            '<p>' + description.substr(0,120) + '...</p>' +
                        '</div>' +
                        '<ul class="facilities-list clearfix">' +
                            '<li>' +
                                '<i class="fa fa-globe"></i>' +
                                '<span> ' + address + '</span>' +
                            '</li>' +
                            '<li>' +
                                '<i class="fa fa-users"></i>' +
                                '<span> ' + property.capacite_habitat + '</span>' +
                            '</li>' +
                        '</ul>' +
                    '</div>';
    return ibContent;
}

function insertPropertyToArray(property, layout) {
    var image = 'public/img/favicon.png';
    if (property.url_photos_habitation) {
        image = 'public/img/photos/habitats/grandes/'+property.url_photos_habitation
    }

    var type = 'type indisponible';
    if (property.libelle_fr_types_bien) {
        type = property.libelle_fr_types_bien
    }

    var title = 'Titre non disponible';
    if (property.titre_habitat) {
        title = property.titre_habitat
    }

    var address = 'lieu inconnu';
    if (property.adresse_habitat) {
        address = property.ville_habitat + ' ('+ property.code_postal_habitat +')'
    }

    var description = 'description non disponible';
    if (property.description_fr_habitat) {
        description = property.description_fr_habitat
    }

    var price = 'prix indisponible';
    if (property.prix_disponibilites) {
        price = property.prix_disponibilites
    }


    var element = '';

    if(layout == 'grid_layout'){
        element = '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="property-2">' +
                        '<!-- Property img -->' +
                        '<div class="property-img">' +
                            '<div class="featured">' + type + '</div>' +
                            '<div class="price-ratings">' +
                                '<div class="price"> ' + price + ' € / nuit</div>';
                                if(property.note != ""){
                                             element += '<div class="ratings">';
                                                for(var i = 0; i < 5; i++){
                                                    if(property.note > i){
                                                        element += '<i class="fa fa-star"></i>';
                                                    }else{
                                                         element += '<i class="fa fa-star-o"></i>';
                                                    }
                                                }
                                             element += '</div>';
                                }
                                 element += '<div class="ratings">' +
                                '</div>' +
                            '</div>' +
                            '<img src="'+image+'" alt="rp" class="img-responsive">' +
                        '</div>' +
                        '<!-- content -->' +
                        '<div class="content">' +
                            '<!-- title -->' +
                            '<h4 class="title">' +
                                '<a href="habitat/' + property.id_habitat + '">' + title + '</a>' +
                            '</h4>' +
                            '<p>' + description.substr(0,120) + '...</p>' +
                        '</div>' +
                        '<ul class="facilities-list clearfix">' +
                            '<li>' +
                                '<i class="fa fa-globe"></i>' +
                                '<span> ' + address + '</span>' +
                            '</li>' +
                            '<li>' +
                                '<i class="fa fa-users"></i>' +
                                '<span> ' + property.capacite_habitat + '</span>' +
                            '</li>' +
                        '</ul>' +
                    '</div>' +
                    '</div>';

    }
    return element;
}

function animatedMarkers(map, propertiesMarkers, properties, layout) {
    var bounds = map.getBounds();
    var propertiesArray = [];
    $.each(propertiesMarkers, function (key, value) {
        if (bounds.contains(propertiesMarkers[key].getLatLng())) {
            propertiesArray.push(insertPropertyToArray(properties.data[key], layout));
            setTimeout(function () {
                if (propertiesMarkers[key]._icon != null) {
                    propertiesMarkers[key]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable bounce-animation marker-loaded';
                }
            }, key * 50);
        }
        else {
            if (propertiesMarkers[key]._icon != null) {
                propertiesMarkers[key]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable';
            }
        }
    });
    $('.fetching-properties').html(propertiesArray);
}

function generateMap(latitude, longitude, mapProvider, layout, properties) {

    var map = L.map('map', {
        center: [latitude, longitude],
        zoom: 13,
        scrollWheelZoom: false
    });

    L.tileLayer.provider(mapProvider).addTo(map);
    var markers = L.markerClusterGroup({
        showCoverageOnHover: false,
        zoomToBoundsOnClick: false
    });
    var propertiesMarkers = [];

    $.each(properties.data, function (index, property) {
        var icon = '<img src="public/img/favicon.png">';
        if (property.icone_bien) {
            icon = '<img src="public/img/type_bien/' + property.icone_bien + '">';
        }
        var color = '';
        var markerContent =
            '<div class="map-marker ' + color + '">' +
            '<div class="icon">' +
            icon +
            '</div>' +
            '</div>';

        var _icon = L.divIcon({
            html: markerContent,
            iconSize: [36, 46],
            iconAnchor: [18, 32],
            popupAnchor: [130, -28],
            className: ''
        });

        var marker = L.marker(new L.LatLng(property.latitude, property.longitude), {
            title: property.title,
            icon: _icon
        });

        propertiesMarkers.push(marker);
        marker.bindPopup(drawInfoWindow(property));
        markers.addLayer(marker);
        marker.on('popupopen', function () {
            this._icon.className += ' marker-active';
        });
        marker.on('popupclose', function () {
            this._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded';
        });
    });

    map.addLayer(markers);
    animatedMarkers(map, propertiesMarkers, properties, layout);
    map.on('moveend', function () {
        animatedMarkers(map, propertiesMarkers, properties, layout);
    });

    $('.fetching-properties .item').hover(
        function () {
            propertiesMarkers[$(this).attr('id') - 1]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded marker-active';
        },
        function () {
            propertiesMarkers[$(this).attr('id') - 1]._icon.className = 'leaflet-marker-icon leaflet-zoom-animated leaflet-clickable marker-loaded';
        }
    );

    $('.geolocation').on("click", function () {
        map.locate({setView: true})
    });
    $('#map').removeClass('fade-map');
}
