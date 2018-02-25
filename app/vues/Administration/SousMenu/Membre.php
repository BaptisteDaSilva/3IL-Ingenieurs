<div id="panel_adminMemebre" class="panel-body panel-avatar">
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Administrateurs') ?></h2>
    </div>
    <?php if ($this->administrateurs == null) { ?>
    <p><?= self::get('Administration', 'Erreur', 'AucunAdministrateur') ?></p>
    <?php } else { ?>
    <form method="post" action="/Administration/supprimerAdmin/">
        <div class="avatars"> 
            <?php foreach ($this->administrateurs as &$admin) { ?>
            <div class="avatar">
                <img src="<?= $admin->getLienAvatar() ?>" alt="<?= $admin->getNomAvatar() ?>" />
                <p>
                    <input id="down<?= $admin->getId() ?>" type="checkbox" name="aDown[]" value="<?= $admin->getId() ?>">
                    <label for="down<?= $admin->getId() ?>"><?= $admin->getLogin() ?></label>
                </p>
            </div>
            <?php } ?> 
        </div>
        <div>
            <input type="submit" name="submitLangue" value="<?= self::get('Administration', 'Bouton', 'Retrograder') ?>" class="btn mon-btn">
        </div>
    </form>
    <?php } ?>
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'Utilisateurs') ?></h2>
    </div> 
    <?php if ($this->utilisateurs == null) { ?>
    <p><?= self::get('Administration', 'Erreur', 'AucunMembre') ?></p>
    <?php } else { ?>
    <form method="post" action="/Administration/ajouterAdmin/" enctype="multipart/form-data">
        <div class="avatars"> 
            <?php foreach ($this->utilisateurs as &$util) { ?>
            <div class="avatar">
                <img src="<?= $util->getLienAvatar() ?>" alt="<?= $util->getNomAvatar() ?>" />
                <p>
                    <input id="up<?= $util->getId() ?>" type="checkbox" name="aUp[]" value="<?= $util->getId() ?>">
                    <label for="up<?= $util->getId() ?>"><?= $util->getLogin() ?></label>
                </p>
            </div>
            <?php } ?> 
        </div>
        <div>
            <input type="submit" name="submitLangue" value="<?= self::get('Administration', 'Bouton', 'Upgrader') ?>" class="btn mon-btn">
        </div>
    </form>
    <div class="panel-heading">
        <h2 class="panel-title"><?= self::get('Administration', 'Libelle', 'SupprimerUtilisateurs') ?></h2>
    </div>
    <form method="post" action="/Administration/supprimerMembre/" enctype="multipart/form-data">
        <div class="avatars"> 
            <?php foreach ($this->utilisateurs as &$util) { ?>
            <div class="avatar">
                <img src="<?= $util->getLienAvatar() ?>" alt="<?= $util->getNomAvatar() ?>" />
                <p>
                    <input id="up<?= $util->getId() ?>" type="checkbox" name="aSupp[]" value="<?= $util->getId() ?>">
                    <label for="up<?= $util->getId() ?>"><?= $util->getLogin() ?></label>
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