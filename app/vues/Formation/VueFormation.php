<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container">
    <div class="panel panel-default bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Formation', 'Annee1', 'Titre') ?></h2>
        </div>
        <div class="panel-body">
            <?php if (self::isAdminConnect()) { ?>
            <form method="post" action="/Administration/modifierTexte/Formation/Annee1/Texte">
                <div class="form-group">
                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Formation', 'Annee1', 'Texte') ?></textarea>
                </div>
            </form>
            <?php } else { ?>
            <?= self::get('Formation', 'Annee1', 'Texte') ?>
            <?php }?>
        </div>
    </div>
    <div class="panel panel-default bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Formation', 'Annee2', 'Titre') ?></h2>
        </div>
        <div class="panel-body">
            <?php if (self::isAdminConnect()) { ?>
            <form method="post" action="/Administration/modifierTexte/Formation/Annee2/Texte">
                <div class="form-group">
                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Formation', 'Annee2', 'Texte') ?></textarea>
                </div>
            </form>
            <?php } else { ?>
            <?= self::get('Formation', 'Annee2', 'Texte') ?>
            <?php }?>
        </div>
    </div>
    <div class="panel panel-default bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Formation', 'Annee3', 'Titre') ?></h2>
        </div>
        <div class="panel-body">
            <?php if (self::isAdminConnect()) { ?>
            <form method="post" action="/Administration/modifierTexte/Formation/Annee3/Texte">
                <div class="form-group">
                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Formation', 'Annee3', 'Texte') ?></textarea>
                </div>
            </form>
            <?php } else { ?>
            <?= self::get('Formation', 'Annee3', 'Texte') ?>
            <?php }?>
        </div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>