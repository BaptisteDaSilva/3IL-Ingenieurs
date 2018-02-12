<?php
use Rodez_3IL_Ingenieurs\Core\Application;

require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container">
    <div class="jumbotron">
        <h1>Bienvenue sur <?= Application::$site->{'Titre'}  ?> !</h1>
        <p>Ecole d'ingénieurs en informatique à Rodez</p>
    </div>    
    <?php if($photos != null) { ?>
    <div id="slider">
        <a href="#slider" class="control_next">&gt;</a>
        <a href="#slider" class="control_prev">&lt;</a>
        <ul>
        <?php foreach ($photos as $photo) { $pName = $photo->getAttribute('name'); ?>
            <li>
                <img src="<?= PHOTOS . $pName ?>" alt="<?= $pName ?>">
                <p class="caption"><?= $doc->getElementById($idSangueUtil . '_' . $pName)->nodeValue ?></p>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>
