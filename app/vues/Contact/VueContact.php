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
                        <?php if (isset($this->statutEnvoie)) { ?>
                            <?php if ($this->statutEnvoie) { ?>
                            <div class="col-md-12">
                                <?php if (self::isAdminConnect()) { ?>
                                <form method="post" action="/Administration/modifierTexte/Contact/EnvoieOK">
                                <div class="form-group">
                                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Contact', 'EnvoieOK') ?></textarea>
                                </div>
                            </form>
                                <?php } else { ?>
                                <?= self::get('Contact', 'EnvoieOK') ?>
                                <?php }?>
                            </div>
                            <?php } else { ?>
                                <div class="col-md-12">
                                    <?php if (self::isAdminConnect()) { ?>
                                    <form method="post" action="/Administration/modifierTexte/Contact/EnvoieKO">
                                <div class="form-group">
                                    <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Contact', 'EnvoieKO') ?></textarea>
                                </div>
                            </form>
                                    <?php } else { ?>
                                    <?= self::get('Contact', 'EnvoieKO') ?>
                                    <?php }?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <?php if (!isset($_SESSION['util'])) { ?>
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
                        <?php } else { ?>
                        <div class="panel-body">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form method="post" action="Contact/sendMail">
                                    <div class="form-group">
                                        <label for="login"><?= self::get('Contact', 'Libelle', 'Expediteur') ?></label>
                                        <input id="login" type="text" class="form-control" name="login" value="<?=$_SESSION['util']->getEmail()?>"
                                            disabled required>
                                    </div>
                                    <div class="form-group">
                                        <label for="objet"><?= self::get('Contact', 'Libelle', 'Objet') ?></label>
                                        <input id="objet" type="text" class="form-control" name="objet"
                                            placeholder="<?= self::get('Contact', 'Placeholder', 'Objet') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message"><?= self::get('Contact', 'Libelle', 'Message') ?></label>
                                        <textarea id="message" class="form-control" name="message"
                                            placeholder="<?= self::get('Contact', 'Placeholder', 'Message') ?>" required></textarea>
                                    </div>
                                    <div>
                                        <input type="submit" name="submit" value="<?= self::get('Contact', 'Bouton', 'Envoyer') ?>"
                                            class="btn mon-btn">
                                    </div>
                                </form>
                            </div>
                        </div>                        
                        <?php } ?>
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