<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#photoView').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#photo").change(function() {
    readURL(this);
});
</script>
<div id="panel_adminPhoto" class="panel-body panel-photo">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php if ($this->photos == null) { ?>
            <p><?= self::get('Administration', 'Erreur', 'AucunePhoto') ?></p>
            <?php } else { ?>
            <form method="post" action="/Administration/supprimerPhoto/">
                <div class="photos"> 
                    <?php foreach ($this->photos as $photo) { ?>
                    <div class="photo">
                        <img src="<?= PHOTOS . $photo ?>" alt="<?= $photo?>" />
                        <p>
                            <input id="supp<?= $photo ?>" type="checkbox" name="aSupp[]" value="<?= $photo ?>">
                            <label for="supp<?= $photo ?>"><?= $photo ?></label>
                        </p>
                    </div>
                    <?php } ?> 
                </div>
                <div>
                    <input type="submit" name="submitLangue" value="<?= self::get('Administration', 'Bouton', 'Supprimer') ?>" class="btn mon-btn">
                </div>
            </form>
            <?php } ?> 
            <div class="panel-heading">
                <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Ajouter') ?></h2>
            </div>
            <form method="post" action="/Administration/ajouterPhoto/" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="photoView">
                        <img id="photoView" src="<?= DEFAUT_IMAGE ?>" alt="Default image" class="photoView" />
                    </div>
                    <input id="photo" type="file" class="form-control" name="photo" accept="image/*" required>
                </div>
                <input type="submit" name="submit" value="<?= self::get('Administration', 'Bouton', 'Ajouter') ?>" class="btn mon-btn">
            </form>
        </div>
    </div>
</div>