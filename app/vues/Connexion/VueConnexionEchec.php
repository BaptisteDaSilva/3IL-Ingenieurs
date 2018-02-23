<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container-page">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-danger bigPanel">
                <div class="panel-heading">
                    <h2 class="panel-title"><?= self::get('SeConnecter', 'TitreKO') ?></h2>
                </div>
                <div class="panel-body">
                    <?= self::get('SeConnecter', 'TexteKO') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>