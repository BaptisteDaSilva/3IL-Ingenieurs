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
                <div class="avatars">                            
                <?php foreach ($avatars as &$avatar) { ?>
                    <div class="avatar">
                        <img src="<?= AVATAR . $avatar->getNom() ?>" alt="<?= $avatar->getNom() ?>" />
                    </div>
                <?php } ?>        
                </div>                      
                <?php if ($avatars != null) { ?>
                <div>
                    <input type="submit" name="submitAvatar" value="Enregistrer" class="btn mon-btn">
                </div>
                <?php } ?> 
            </form>
        </div>
    </div>
</div>