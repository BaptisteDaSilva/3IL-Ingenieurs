<script>
$('#panel_monAvatar img').click(function(){
	   $('.selected').removeClass('selected'); // removes the previous selected class
	   $(this).addClass('selected'); // adds the class to the clicked image


	document.getElementById("nomAvatar").value = $('.selected')[0].alt;
});
</script>
<div id="panel_monAvatar" class="panel-body panel-avatar">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="post" action="/MonCompte/modifierAvatar/">
                <input type="hidden" name="nomAvatar" id="nomAvatar" value="<?= $_SESSION['util']->getNomAvatar() ?>" />			
        		<?php
        if ($dossier = opendir('../public/img/avatar')) {
            while (false !== ($avatar = readdir($dossier))) {
                if ($avatar != '.' && $avatar != '..' && $avatar != 'defaut.png') {
                    if ($avatar == $_SESSION['util']->getNomAvatar()) {
                        echo '<img class="selected" src="' . AVATAR . $avatar . '" alt="' . $avatar . '"/>';
                    } else {
                        echo '<img src="' . AVATAR . $avatar . '" alt="' . $avatar . '"/>';
                    }
                }
            }
        }
        ?>
                <div>
                    <input type="submit" name="submitAvatar" value="Enregistrer" class="btn mon-btn">
                </div>
            </form>
        </div>
    </div>
</div>