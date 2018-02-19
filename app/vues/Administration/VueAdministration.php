<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<script>
window.onload = function() {	
	loadMenu('<?= $this->menu; ?>');
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= self::get('Administration', 'Titre') ?></h3>
                </div>
                <div class="panel-heading panel-navigation">
                    <input type="button" value="<?= self::get('Administration', 'Menu', 'Avatar') ?>" onclick="loadMenu('Avatar')" />
                    <input type="button" value="<?= self::get('Administration', 'Menu', 'Langue') ?>" onclick="loadMenu('Langue')" />
                    <input type="button" value="<?= self::get('Administration', 'Menu', 'Membre') ?>" onclick="loadMenu('Membre')" />
                    <input type="button" value="<?= self::get('Administration', 'Menu', 'Photo') ?>" onclick="loadMenu('Photo')" />
                    <input type="button" value="<?= self::get('Administration', 'Menu', 'DescriptionPhoto') ?>" onclick="loadMenu('DescriptionPhoto')" />
                </div>
                <div id="contentAdministration"></div>
            </div>
        </div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>