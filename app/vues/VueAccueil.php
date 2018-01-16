<?php
    require_once TEMPLATES . 'enTete.php';
    require_once TEMPLATES . 'menu.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="post" action="/GeoVilles/ville/rechercher/">
                <div class="input-group">
                    <div class="input-group-addon"><span
                            class="fa fa-search"></span></div>
                    <input type="text" class="form-control input-rechercher"
                           required="" name="ville"
                           placeholder="Rechercher une ville de France ...">
                </div>
            </form>
        </div>
    </div>
    <div class="jumbotron">
        <h1>Bienvenue sur Géo Villes !</h1>
        <p>Consulter toutes les informations sur les régions, les
            départements et les villes de France !</p>
    </div>
</div>
