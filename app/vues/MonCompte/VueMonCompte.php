<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<script>
window.onload = function() {
	loadMenu('Compte');
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default bigPanel">
                <div class="panel-heading panel-navigation">
                    <input type="button" value="Mon Compte" onclick="loadMenu('Compte')" />
                    <input type="button" value="Mon avatar" onclick="loadMenu('Avatar')" />
                    <input type="button" value="Ma langue" onclick="loadMenu('Langue')" />
					<?php if($_SESSION['util']->isAdmin()) { ?>
    					<input type="button" value="Admin avatar" onclick="loadMenu('AdminAvatar')" />
                    <input type="button" value="Admin langue" onclick="loadMenu('AdminLangue')" />
                    <input type="button" value="Admin membre" onclick="loadMenu('AdminMembre')" />
					<?php } ?>
				</div>
                <div id="contentMonCompte"></div>
            </div>
        </div>
    </div>
</div>