<script>
$('#panel_maLangue img').click(function(){
    $('.selected').removeClass('selected'); // removes the previous selected class
    $(this).addClass('selected'); // adds the class to the clicked image
    
    document.getElementById("nomLangue").value = $('.selected')[0].alt;
});
</script>
<div id="panel_maLangue" class="panel-body panel-langue">					
    <?php if ($this->langues == null) { ?>
    <div class="panel panel-default panel-danger bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('MonCompte', 'Erreur', 'AucuneLangue') ?></h2>
        </div>
    </div>
    <?php } else { ?>
    <form method="post" action="/MonCompte/modifierLangue/">
        <input type="hidden" name="nomLangue" id="nomLangue" value="<?= $_SESSION['util']->getNomLangue() ?>" />
        <div class="drapeaux"> 
            <?php foreach ($this->langues as &$langue) { ?>
            <div class="drapeau">
                <?php if ($langue->getNom() == $_SESSION['util']->getNomLangue()) { ?>
                <img class="selected" src="<?= DRAPEAU . $langue->getNomDrapeau() ?>" alt="<?= $langue->getNom() ?>" />
                <?php } else { ?>
                <img src="<?= DRAPEAU . $langue->getNomDrapeau() ?>" alt="<?= $langue->getNom() ?>" />
                <?php } ?>
                <p><?= $langue->getNom() ?></p>
            </div>
            <?php } ?>
        </div>
        <div>
            <input type="submit" name="submitLangue" value="<?= self::get('MonCompte', 'Bouton', 'Modifier') ?>" class="btn mon-btn">
        </div>
    </form>
    <?php } ?>
</div>