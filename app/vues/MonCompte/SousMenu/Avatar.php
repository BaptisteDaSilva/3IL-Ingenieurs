<script>
$('#panel_monAvatar img').click(function(){
    $('.selected').removeClass('selected'); // removes the previous selected class
    $(this).addClass('selected'); // adds the class to the clicked image


    document.getElementById("nomAvatar").value = $('.selected')[0].alt;
});
</script>
<div id="panel_monAvatar" class="panel-body panel-avatar">
    <?php if ($this->avatars == null) { ?>
    <div class="panel panel-default panel-danger bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('MonCompte', 'Erreur', 'AucunAvatar') ?></h2>
        </div>
    </div>
    <?php } else { ?>
    <form method="post" action="/MonCompte/modifierAvatar/">
        <input type="hidden" name="nomAvatar" id="nomAvatar" value="<?= $_SESSION['util']->getNomAvatar() ?>" />
        <div class="avatars"> 
            <?php foreach ($this->avatars as &$avatar) { ?> 
                <div class="avatar">
                <?php if ($avatar->getNom() == $_SESSION['util']->getNomAvatar()) { ?>
                    <img class="selected" src="<?= AVATAR . $avatar->getNom() ?>" alt="<?= $avatar->getNom() ?>" />
                <?php } else { ?>
                    <img src="<?= AVATAR . $avatar->getNom() ?>" alt="<?= $avatar->getNom() ?>" />
                <?php } ?>
                </div>
            <?php } ?> 
        </div>
        <div>
            <input type="submit" name="submitAvatar" value="<?= self::get('MonCompte', 'Bouton', 'Modifier') ?>" class="btn mon-btn">
        </div>
    </form>
    <?php } ?>
</div>