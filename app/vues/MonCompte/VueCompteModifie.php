<?php
    require_once TEMPLATES . 'enTete.php';
    require_once TEMPLATES . 'menu.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
                if ($this->modifOK) {
                    echo '<div class="panel panel-success bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title">Modifiation Réussie !</h3>
                </div>
                <div class="panel-body">
                    Les modifications que vos avez effectué sur votre compte
                    ont bien été prises en compte.
                </div>
            </div>';
                } else {
                    echo '<div class="panel panel-danger bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title">Erreur durant le modification !</h3>
                </div>
                <div class="panel-body">
                    Un problème est survenu lors de la modification de vos
                    données.<br>
                    Merci de réessayer.
                </div>
            </div>';
                }
            ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
