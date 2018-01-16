/*
 * Fichier contenant les fonction permettant d'afficher la Google Map.
 */

/**
 * Fonction permettant d'initialiser la Google Map.
 */
function initMap() {
    
    // Récupère la latitude et logitude de la ville.
    var lat = document.getElementById("lat").textContent;
    var long = document.getElementById("long").textContent;
    
    // Créé un objet de ces deux variables.
    var latlong = {
        lat: parseFloat(lat), lng: parseFloat(long)
    };
    
    // Créé la map dans le div avec l'id "map".
    var map = new google.maps.Map(document.getElementById('map'), {
        
        // Pour que la map soit une map satellite.
        mapTypeId: google.maps.MapTypeId.HYBRID
    });

    /* 
     * Initialise les objets de géolocalisation de la ville
     * par rapport à ses coordonnées.
     */
    var geocoder = new google.maps.Geocoder;
    var infowindow = new google.maps.InfoWindow;
    var service = new google.maps.places.PlacesService(map);
    
    // Identifie la ville.
    geocodeLatLng(geocoder, map, infowindow, latlong, service);
}

/**
 * Permet d'identifier la ville grâce au coordonnées GPS de la ville.
 * @param {google.maps.Geocoder} geocoder l'objet de géolocalisation.
 * @param {google.maps.Map} map la carte ou afficher la ville.
 * @param {google.maps.InfoWindow} infowindow une pop-up ou afficher 
 *                                            le nom de la ville
 * @param {object} latlong la latitude et logitude de la ville
 * @param {google.maps.places.PlacesService} service le service Google
 *                                 permettant chercher dans la base de donnée 
 *                                 des villesn de Google.
 */
function geocodeLatLng(geocoder, map, infowindow, latlong, service) {
    
    // Cherche la ville la plus proche selon les coordonnées
    geocoder.geocode({'location': latlong}, function (results, status) {
        
        // Si il existe des villes proche de ces coordonnées.
        if (status === google.maps.GeocoderStatus.OK) {
            
            // On prend le second résultat (recommendé par Google)
            if (results[1]) {
                
                // Modifie le zoom de la map
                map.setZoom(12);
                
                // Récupère les détails de la ville
                service.getDetails({
                    
                    // L'ID de la ville dans la base de donnée de Google
                    placeId: results[1].place_id
                    
                // Va chercher les informations de la ville
                }, function (place, status) {
                    
                    // Si une ville existe avec cet ID
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        
                        // Ajoute un marqueur sur la map à l'emplacement de la ville.
                        var marker = new google.maps.Marker({
                            map: map,
                            animation: google.maps.Animation.DROP,
                            position: place.geometry.location
                        });
                        
                        // Centre la map sur la ville
                        map.setCenter(place.geometry.location);
                        
                        // Ajoute la pop-up avec le nom de la ville
                        infowindow.setContent(place.name);
                        infowindow.open(map, marker);
                    }
                });
                
            // Si aucunes ville n'est présente à ces coordonées.
            } else {
                window.alert('La carte n\'a pas trouvé de résultats.');
            }
            
        // Si la géolocalisation a rencontrée un problème.
        } else {
            window.alert('Problème avec Géocode :  ' + status);
        }
    });
}