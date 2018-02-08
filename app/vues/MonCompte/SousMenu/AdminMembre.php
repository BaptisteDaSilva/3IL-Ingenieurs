<div id="panel_adminMemebre" class="panel-body panel-avatar">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel-heading">
                <h3 class="panel-title">Administrateur :</h3>
            </div>
            <?php if ($administrateurs != null) { ?>
            <form method="post" action="/Administration/supprimerAdmin/">
                <div class="avatars">                            
                <?php foreach ($administrateurs as &$admin) { ?>
                    <div class="avatar">
                        <img src="<?= AVATAR . $admin->getNomAvatar() ?>" alt="<?= $admin->getNomAvatar() ?>" />
                        <p>
                            <input id="down<?= $admin->getId() ?>" type="checkbox" name="aDown[]" value="<?= $admin->getId() ?>">
                            <label for="down<?= $admin->getId() ?>"><?= $admin->getLogin() ?></label>
                        </p>
                    </div>
                <?php } ?>        
                </div>
                <div>
                    <input type="submit" name="submitLangue" value="Retrograder" class="btn mon-btn">
                </div>
                <?php } ?> 
            </form>
            <div class="panel-heading">
                <h3 class="panel-title">Utilisateurs :</h3>
            </div>                             
            <?php if ($utilisateurs != null) { ?>
            <form method="post" action="/Administration/ajouterAdmin/" enctype="multipart/form-data">
                <div class="avatars">                            
                <?php foreach ($utilisateurs as &$util) { ?>
                    <div class="avatar">
                        <img src="<?= AVATAR . $util->getNomAvatar() ?>" alt="<?= $util->getNomAvatar() ?>" />
                        <p>
                            <input id="up<?= $util->getId() ?>" type="checkbox" name="aUp[]" value="<?= $util->getId() ?>">
                            <label for="up<?= $util->getId() ?>"><?= $util->getLogin() ?></label>
                        </p>
                    </div>
                <?php } ?>        
                </div>
                <div>
                    <input type="submit" name="submitLangue" value="Upgrader" class="btn mon-btn">
                </div>
                <?php } ?> 
            </form>
        </div>
    </div>
</div>