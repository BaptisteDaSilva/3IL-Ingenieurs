<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container">
    <div class="panel panel-default bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Apprentissage', 'Titre') ?></h2>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                <?php if (self::isAdminConnect()) { ?>
                <form method="post" action="/Administration/modifierTexte/Apprentissage/Texte">
                        <div class="form-group">
                            <textarea class='form-control' id="textareaNew" name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Apprentissage', 'Texte') ?></textarea>
                        </div>
                    </form>
                <?php } else { ?>
                <?= self::get('Apprentissage', 'Texte') ?>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>