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
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Ajouter') ?></h2>
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
            <input id="drapeau" type="file" class="form-control" name="drapeau" accept="<?= EXTENSION_PNG ?>" required>
        </div>
        <div class="form-group">
            <label for="propertie"><?= self::get('Administration', 'Libelle', 'FichierProperties') ?><a
                    href="/Administration/defaultProperties/"><?= self::get('Administration', 'Libelle', 'ARemplir') ?></a>
            </label>
            <input id="propertie" type="file" class="form-control" name="propertie" accept="<?= EXTENSION_PROPERTIES ?>" >
        </div>
        <input type="submit" name="submit" value="<?= self::get('Administration', 'Bouton', 'Ajouter') ?>" class="btn mon-btn">
    </form>
    <?php if ($this->langues == null) { ?>
    <div class="panel panel-default panel-danger bigPanel">
        <div class="panel-heading">
            <h2 class="panel-title"><?= self::get('Administration', 'Erreur', 'AucuneLangue') ?></h2>
        </div>
    </div>
    <?php } else { ?>
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Langues') ?></h2>
    </div>
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
</div>