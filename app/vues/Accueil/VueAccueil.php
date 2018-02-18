<?php
use Rodez_3IL_Ingenieurs\Core\Application;
use Rodez_3IL_Ingenieurs\Libs\Photo;

require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1>Bienvenue sur <?= Application::$site->{'Titre'}  ?> !</h1>
        <p>Ecole d'ingénieurs en informatique à Rodez</p>
    </div>    
    <?php if(self::$photos != null) { ?>
    <div id="slider">
        <a href="#slider" class="control_next">&gt;</a>
        <a href="#slider" class="control_prev">&lt;</a>
        <ul>
        <?php foreach (self::$photos as $photo) { $pName = Photo::getName($photo);?>
            <li>
                <img src="<?= PHOTOS . $pName ?>" alt="<?= $pName ?>">
                <p class="caption"><?= Photo::getDescription($pName, $idSangueUtil) ?></p>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>