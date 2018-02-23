<div id="panel_adminPhoto" class="panel-body panel-photo">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php if ($this->descriptions == null) { ?>
            <p><?= self::get('Administration', 'Erreur', 'Slider') ?></p>
            <?php } else { ?>
            <?php foreach ($this->descriptions as $description) { ?>
            <div class="panel-heading">
                <h2 class="panel-title"><?= $description['langue']->getNom() ?></h2>
            </div>
            <form method="post" action="/Administration/modifierDescriptionPhoto/">
                <input type="hidden" name="idLangue" value="<?= $description['langue']->getId() ?>" />
                <div class="photos"> 
                    <?php foreach ($description['photos'] as $photo) { ?>
                    <div class="photo">
                        <img src="<?= PHOTOS . $photo['name'] ?>" alt="<?= $photo['name'] ?>" />
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
            <?php } ?>
        </div>
    </div>
</div>
