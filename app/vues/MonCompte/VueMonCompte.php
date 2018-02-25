<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<script>
window.onload = function() {	
	loadMenu('<?= isset($_SESSION['menu']) ? $_SESSION['menu'] : $this->MENU_DEFAUT ?>');
};

function loadMenu(Page) {	
 $('#contentMonCompte').load("/MonCompte/SousMenu/" + Page); 
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
            <h2 class="panel-title"><?= self::get('MonCompte', 'Titre') ?></h2>
        </div>
        <div class="panel-navigation">
            <input type="button" value="<?= self::get('MonCompte', 'Menu', 'Compte') ?>" onclick="loadMenu('Compte')" />
            <input type="button" value="<?= self::get('MonCompte', 'Menu', 'Avatar') ?>" onclick="loadMenu('Avatar')" />
            <input type="button" value="<?= self::get('MonCompte', 'Menu', 'Langue') ?>" onclick="loadMenu('Langue')" />
        </div>
        <?php if (isset($this->modifOK)) { ?>
        <?php if ($this->modifOK) { ?>
        <div class="panel-success bigPanel">
            <div class="panel-heading">
                <h2 class="panel-title"><?= self::get('MonCompte', 'TitreOK') ?></h2>
            </div>
        </div>
        <?php } else { ?>
        <div class="panel-danger bigPanel">
            <div class="panel-heading">
                <h2 class="panel-title"><?= self::get('MonCompte', 'TitreKO') ?></h2>
            </div>
        </div>
        <?php }?>
        <?php }?>
        <div id="contentMonCompte"></div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>