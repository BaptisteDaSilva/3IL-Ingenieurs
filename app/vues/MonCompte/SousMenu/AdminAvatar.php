<script type="text/javascript">
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#avatarView').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#avatar").change(function() {
  readURL(this);
});
</script>
<div id="panel_adminAvatar" class="panel-body panel-avatar">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
            <?php if ($this->avatars != null) { ?>
            <form method="post"
				action="/Administration/supprimerAvatar/">
				<div class="avatars">                            
                <?php foreach ($this->avatars as &$avatar) { ?>
                    <div class="avatar">
						<img src="<?= AVATAR . $avatar->getNom() ?>"
							alt="<?= $avatar->getNom() ?>" />
						<p>
							<input id="supp<?= $avatar->getId() ?>" type="checkbox"
								name="aSupp[]" value="<?= $avatar->getId() ?>"> <label
								for="supp<?= $avatar->getId() ?>"><?= $avatar->getNom() ?></label>
						</p>
					</div>
                <?php } ?>        
                </div>
				<div>
					<input type="submit" name="submitLangue" value="Supprimer"
						class="btn mon-btn">
				</div>
			</form>
            <?php } ?> 
            <div class="panel-heading">
				<h3 class="panel-title">Ajouter :</h3>
			</div>
			<form method="post" action="/Administration/ajouterAvatar/"
				enctype="multipart/form-data">
				<div class="form-group">
					<div class="avatarView">
						<img id="avatarView" src="<?= DEFAUT_AVATAR ?>"
							alt="Default image" class="avatarView" />
					</div>
					<input id="avatar" type="file" class="form-control" name="avatar"
						accept="image/*" required>
				</div>
				<input type="submit" name="submit" value="Ajouter"
					class="btn mon-btn">
			</form>
		</div>
	</div>
</div>