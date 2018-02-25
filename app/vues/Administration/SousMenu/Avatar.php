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
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Ajouter') ?></h2>
    </div>
    <form method="post" action="/Administration/ajouterAvatar/" enctype="multipart/form-data">
        <div class="form-group">
            <div class="avatarView">
                <img id="avatarView" src="<?= DEFAUT_AVATAR ?>" alt="Default image" class="avatarView" />
            </div>
            <input id="avatar" type="file" class="form-control" name="avatar" accept="<?= EXTENSION_IMAGE ?>" required>
        </div>
        <input type="submit" name="submit" value="<?= self::get('Administration', 'Bouton', 'Ajouter') ?>" class="btn mon-btn">
    </form>
    <?php if ($this->avatars == null) { ?>
    <div class="panel panel-default panel-danger bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Administration', 'Erreur', 'AucunAvatar') ?></h2>
        </div>
    </div>
    <?php } else { ?>
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Avatars') ?></h2>
    </div>
    <form method="post" action="/Administration/supprimerAvatar/">
        <div class="avatars"> 
            <?php foreach ($this->avatars as $avatar) { ?>
            <div class="avatar">
                <img src="<?= AVATAR . $avatar->getNom() ?>" alt="<?= $avatar->getNom() ?>" />
                <p>
                    <input id="supp<?= $avatar->getId() ?>" type="checkbox" name="aSupp[]" value="<?= $avatar->getId() ?>">
                    <label for="supp<?= $avatar->getId() ?>"><?= $avatar->getNom() ?></label>
                </p>
            </div>
            <?php } ?> 
        </div>
        <div>
            <input type="submit" name="submitLangue" value="<?= self::get('Administration', 'Bouton', 'Supprimer') ?>" class="btn mon-btn">
        </div>
    </form>
    <?php } ?> 
</div>