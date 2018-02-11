<script>
$('#panel_maLangue img').click(function(){
	   $('.selected').removeClass('selected'); // removes the previous selected class
	   $(this).addClass('selected'); // adds the class to the clicked image


	document.getElementById("nomLangue").value = $('.selected')[0].alt;
});
</script>
<div id="panel_maLangue" class="panel-body panel-langue">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">							
		<?php if ($this->langues == null) { ?>
		    <p>Aucune langue n'a été définis</p>
		<?php } else { ?>
            <form method="post" action="/MonCompte/modifierLangue/">
                <input type="hidden" name="nomLangue" id="nomLangue" value="<?= $_SESSION['util']->getNomLangue() ?>" />
                <div class="drapeaux">  
                <?php
                foreach ($this->langues as &$langue) {
                    if ($langue->getNom() == $_SESSION['util']->getNomLangue()) {
                ?>
                    	<div class="drapeau">
                            <img class="selected" src="<?= DRAPEAU . $langue->getNomDrapeau() ?>" alt="<?= $langue->getNom() ?>" />
                            <p><?= $langue->getNom() ?></p>
                        </div>
                <?php } else { ?>
                        <div class="drapeau">
                            <img src="<?= DRAPEAU . $langue->getNomDrapeau() ?>" alt="<?= $langue->getNom() ?>" />
                            <p><?= $langue->getNom() ?></p>
                        </div>
                <?php
                    }
                }
                ?>
                </div>
                <div>
                    <input type="submit" name="submitLangue" value="Enregistrer" class="btn mon-btn">
                </div>
            </form>
        <?php
		}
        ?>
        </div>
    </div>
</div>