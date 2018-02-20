<div id="panel_adminMemebre" class="panel-body panel-avatar">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel-heading">
                <h3 class="panel-title"><?= self::get('Administration', 'Libelle', 'Utilisateurs') ?></h3>
            </div> 
            <?php if ($this->utilisateurs != null) { ?>
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
            <?php } ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?= self::get('Administration', 'Libelle', 'SupprimerUtilisateurs') ?></h3>
            </div> 
            <?php if ($this->utilisateurs != null) { ?>
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
            <div class="panel-heading">
                <h3 class="panel-title"><?= self::get('Administration', 'Libelle', 'Administrateurs') ?></h3>
            </div>
            <?php if ($this->administrateurs != null) { ?>
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
        </div>
    </div>
</div>