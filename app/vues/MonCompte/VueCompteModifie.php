<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php if ($this->modifOK) { ?>
            <div class="panel panel-success bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= self::get('MonCompte', 'TitreOK') ?></h3>
                </div>
                <div class="panel-body">
                    <?= self::get('MonCompte', 'TexteOK') ?>
                </div>
            </div>
            <?php } else { ?>
            <div class="panel panel-danger bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= self::get('MonCompte', 'TitreKO') ?></h3>
                </div>
                <div class="panel-body">
                    <?= self::get('MonCompte', 'TexteKO') ?>
                </div>
            </div>
            <?php }?>
            </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>