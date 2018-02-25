<div id="panel_adminPhoto" class="panel-body panel-photo">
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Ajouter') ?></h2>
    </div>
    <form method="post" action="/Administration/ajouterPhotoSlider/" enctype="multipart/form-data">
        <div class="form-group">
            <div class="photoView">
                <img id="photoView" src="<?= DEFAUT_IMAGE ?>" alt="Default image" class="photoView" />
            </div>
            <input id="photo" type="file" class="form-control" name="photo" accept="<?= EXTENSION_IMAGE ?>" required>
        </div>
        <input type="submit" name="submit" value="<?= self::get('Administration', 'Bouton', 'Ajouter') ?>" class="btn mon-btn">
    </form> 
    <?php if ($this->photosSlider == null) { ?>
    <div class="panel panel-default panel-danger bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Administration', 'Erreur', 'AucunePhotoSlider') ?></h2>
        </div>
    </div>
    <?php } else { ?>
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Photos') ?></h2>
    </div>
    <form method="post" action="/Administration/supprimerPhotoSlider/">
        <div class="photos"> 
            <?php foreach ($this->photosSlider as $photo) { ?>
            <div class="photo">
                <img src="<?= SLIDER . $photo ?>" alt="<?= $photo?>" />
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Description') ?></h2>
        </div>
        <?php foreach ($this->descriptions as $description) { ?>
        <div class="panel-heading">
            <h2 class="panel-title"><?= $description['langue']->getNom() ?></h2>
        </div>
        <form method="post" action="/Administration/modifierDescriptionPhoto/">
            <input type="hidden" name="idLangue" value="<?= $description['langue']->getId() ?>" />
            <div class="photos"> 
                <?php foreach ($description['photos'] as $photo) { ?>
                <div class="photo">
                    <img src="<?= SLIDER . $photo['name'] ?>" alt="<?= $photo['name'] ?>" />
                    <input class="form-control" id="<?= $photo['name'] ?>" type="text" name="photos[<?= $photo['name'] ?>]"
                        placeholder="<?= self::get('Administration', 'Placeholder', 'AjouterDescription') ?>" value="<?= $photo['desc'] ?>" />
                </div>
                <?php } ?> 
            </div>
            <div>
                <input type="submit" name="submitLangue" value="<?= self::get('Administration', 'Bouton', 'Modifier') ?>" class="btn mon-btn">
            </div>
        </form>
        <?php } ?>
    </div>
    <?php } ?>
</div>
