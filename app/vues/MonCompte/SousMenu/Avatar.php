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
        <?php if ($this->avatars == null) { ?>
            <p>Aucune avatar n'a été définis</p>
        <?php } else { ?>
            <form method="post" action="/MonCompte/modifierAvatar/">
                <input type="hidden" name="nomAvatar" id="nomAvatar" value="<?= $_SESSION['util']->getNomAvatar() ?>" />
                <div class="avatars">                            
                <?php
                foreach ($this->avatars as &$avatar) {
                    if ($avatar->getNom() == $_SESSION['util']->getNomAvatar()) {
                ?>
                    <div class="avatar">
                        <img class="selected" src="<?= AVATAR . $avatar->getNom() ?>" alt="<?= $avatar->getNom() ?>" />
                    </div>
                <?php
                    } else {
                ?>                
                    <div class="avatar">
                        <img src="<?= AVATAR . $avatar->getNom() ?>" alt="<?= $avatar->getNom() ?>" />
                    </div>
                <?php
                    }
                }
                ?>   
                </div>
                <div>
                    <input type="submit" name="submitAvatar" value="Enregistrer" class="btn mon-btn">
                </div>
            </form>
        <?php
        }
        ?>
        </div>
    </div>
</div>