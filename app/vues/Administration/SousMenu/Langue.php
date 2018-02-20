<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#drapeauView').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#drapeau").change(function() {
    readURL(this);
});
</script>
<div id="panel_adminLangue" class="panel-body panel-langue">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8"> 
        <?php if ($this->langues != null) { ?>
        <form method="post" action="/Administration/supprimerLangue/">
                <div class="drapeaux"> 
                <?php foreach ($this->langues as &$langue) { ?>
                <div class="drapeau">
                        <img src="<?= DRAPEAU . $langue->getNomDrapeau() ?>" alt="<?= $langue->getNom() ?>" />
                        <p>
                            <input id="supp<?= $langue->getId() ?>" type="checkbox" name="aSupp[]" value="<?= $langue->getId() ?>">
                            <label for="supp<?= $langue->getId() ?>"><?= $langue->getNom() ?></label>
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
                <h3 class="panel-title"><?= self::get('Administration', 'Libelle', 'Ajouter') ?></h3>
            </div>
            <form method="post" action="/Administration/ajouterLangue/" enctype="multipart/form-data">
                <div class="form-group">
                    <input id="id" type="text" class="form-control" name="id"
                        placeholder="<?= self::get('Administration', 'Placeholder', 'CodeLangue') ?>" maxlength="2" required>
                </div>
                <div class="form-group">
                    <input id="nom" type="text" class="form-control" name="nom"
                        placeholder="<?= self::get('Administration', 'Placeholder', 'NomLangue') ?>" maxlength="20" required>
                </div>
                <div class="form-group">
                    <div class="drapeauView">
                        <img id="drapeauView" src="<?= DEFAUT_IMAGE ?>" alt="Default image" class="drapeauView" />
                    </div>
                    <input id="drapeau" type="file" class="form-control" name="drapeau" accept="image/png" required>
                </div>
                <div class="form-group">
                    <label for="propertie"><?= self::get('Administration', 'Libelle', 'FichierProperties') ?><a
                            href="/Administration/defaultProperties/"><?= self::get('Administration', 'Libelle', 'ARemplir') ?></a>
                    </label>
                    <input id="propertie" type="file" class="form-control" name="propertie" accept=".json">
                </div>
                <input type="submit" name="submit" value="<?= self::get('Administration', 'Bouton', 'Ajouter') ?>" class="btn mon-btn">
            </form>
        </div>
    </div>
</div>