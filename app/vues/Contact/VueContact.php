<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= self::get('Contact', 'Titre') ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (self::isAdminConnect()) { ?>
                            <form method="post" action="/Administration/modifierTexte/Contact/Texte">
                                <div class="form-group">
                                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Contact', 'Texte') ?></textarea>
                                </div>
                            </form>
                        <?php } else { ?>
                        <?= self::get('Contact', 'Texte') ?>
                        <?php }?>
                        </div>
                        <form method="post" action="Contact/sendMail">
                            <div class="form-group">
                                <textarea name="new" class="form-control" ><?= self::get('Contact', 'Texte') ?></textarea>
                            </div>
                            <div>
                                <input type="submit" name="submitMail" value="Envoyer" class="btn mon-btn">
                            </div>
                        </form>
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