<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<script>
window.onload = function() {	
	loadMenu('<?= isset($_SESSION['menuAdmin']) ? $_SESSION['menuAdmin'] : $this->MENU_DEFAUT ?>');
};

function loadMenu(Page) {	
 $('#contentAdministration').load("/Administration/SousMenu/" + Page); 
}

$(function(){
	$('#panel_monAvatar img').click(function(){
		 $('.selected').removeClass('selected'); // removes the previous selected class
		 $(this).addClass('selected'); // adds the class to the clicked image


		document.getElementById("nomAvatar").value = $('.selected')[0].alt;
	});
	
	$('#panel_maLangue img').click(function(){
		 $('.selected').removeClass('selected'); // removes the previous selected class
		 $(this).addClass('selected'); // adds the class to the clicked image


		document.getElementById("nomLangue").value = $('.selected')[0].alt;
	});
});
</script>
<div class="container">
    <div class="panel panel-default bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Administration', 'Titre') ?></h2>
        </div>
        <div class="panel-heading panel-navigation">
            <input type="button" value="<?= self::get('Administration', 'Menu', 'Avatar') ?>" onclick="loadMenu('Avatar')" />
            <input type="button" value="<?= self::get('Administration', 'Menu', 'Langue') ?>" onclick="loadMenu('Langue')" />
            <input type="button" value="<?= self::get('Administration', 'Menu', 'Photo') ?>" onclick="loadMenu('Photo')" />
            <input type="button" value="<?= self::get('Administration', 'Menu', 'DescriptionPhoto') ?>" onclick="loadMenu('DescriptionPhoto')" />
            <?php if (self::isSuperAdminConnect()) { ?>
            <input type="button" value="<?= self::get('Administration', 'Menu', 'Membre') ?>" onclick="loadMenu('Membre')" />
            <?php } ?>
        </div>
        <?php if (isset($this->modifOK)) { ?>
            <?php if ($this->modifOK) { ?>
            <div class="panel panel-success bigPanel">
            <div class="panel-heading">
                <h2 class="panel-title"><?= self::get('Administration', 'TitreOK') ?></h2>
            </div>
            <div class="panel-body">
                    <?= self::get('Administration', 'TexteOK') ?>
                </div>
        </div>
            <?php } else { ?>
            <div class="panel panel-danger bigPanel">
            <div class="panel-heading">
                <h2 class="panel-title"><?= self::get('Administration', 'TitreKO') ?></h2>
            </div>
            <div class="panel-body">
                    <?= self::get('Administration', 'TexteKO') ?>
                </div>
        </div>
            <?php }?>
        <?php }?>
        <div id="contentAdministration"></div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>