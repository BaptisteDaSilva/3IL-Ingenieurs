<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container">
<div class="jumbotron">
    <?php if (self::isAdminConnect()) { ?>
    <form method="post" action="/Administration/modifierTexte/Accueil/Presentation/Titre">
        <div class="form-group">
            <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Accueil', 'Presentation', 'Titre') ?></textarea>
        </div>
    </form>
    <form method="post" action="/Administration/modifierTexte/Accueil/Presentation/Texte">
        <div class="form-group">        
            <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Accueil', 'Presentation', 'Texte') ?></textarea>
        </div>
    </form>
    <?php } else { ?>
    <h1><?= self::get('Accueil', 'Presentation', 'Titre') ?></h1>
    <p><?= self::get('Accueil', 'Presentation', 'Texte') ?></p>
    <?php }?>
</div> 
<?php if(self::$photos != null) { ?>
<div id="slider">
    <a href="#slider" class="control_next">&gt;</a> <a href="#slider" class="control_prev">&lt;</a>
    <ul>
        <?php foreach (self::$photos as $photo) { ?>
        <li>
            <img src="<?= PHOTOS . $photo['name'] ?>" alt="<?= $photo['name'] ?>">
            <p class="caption"><?= $photo['desc'] ?></p>
        </li>
        <?php } ?>
    </ul>
</div>
<?php } ?>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>