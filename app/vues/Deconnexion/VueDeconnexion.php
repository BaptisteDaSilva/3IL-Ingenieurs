<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-success bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= self::get('Deconnexion', 'TitreOk') ?></h3>
                </div>
                <div class="panel-body">
                    <?php if (self::isAdminConnect()) { ?>
                    <form method="post" action="/Administration/modifierTexte/Deconnexion/Texte">
                        <div class="form-group">
                            <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Contact', 'Texte') ?></textarea>
                        </div>
                    </form>
                    <?php } else { ?>
                    <p><?= self::get('Deconnexion', 'Texte') ?></p>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>