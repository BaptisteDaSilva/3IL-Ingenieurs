<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<script>
function initMap() {
var map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: 44.3593909, lng: 2.5564536},
  zoom: 16
});

var infowindow = new google.maps.InfoWindow();
var service = new google.maps.places.PlacesService(map);

service.getDetails({
  placeId: 'ChIJg0r9JO19shIR2lOJx3tuZ7E'
}, function(place, status) {
  if (status === google.maps.places.PlacesServiceStatus.OK) {
    var marker = new google.maps.Marker({
      map: map,
      position: place.geometry.location
    });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
        'Place ID: ' + place.place_id + '<br>' +
        place.formatted_address + '</div>');
      infowindow.open(map, this);
    });
  }
});
}
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default bigPanel">
                <div class="panel-heading panel-navigation">
                    <h3 class="panel-title"><?= self::get('Rodez', 'Titre') ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map"></div>
                            <script async defer src="https://maps.googleapis.com/maps/api/js?key= AIzaSyBh1og4fND2nSzGd_zg1YOY6EubODBmdAI&libraries=places&callback=initMap"></script>
                            <?php if (self::isAdminConnect()) { ?>
                            <form method="post" action="/Administration/modifierTexte/Rodez/Texte">
                                <div class="form-group">
                                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Rodez', 'Texte') ?></textarea>
                                </div>
                            </form>
                            <?php } else { ?>
                            <div class="modif-texte">
                                <?= self::get('Rodez', 'Texte') ?>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>