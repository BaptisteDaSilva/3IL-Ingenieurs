<div id="panel_monCompte" class="panel-body panel-compte">
    <form method="post" action="/MonCompte/modifier/">
        <div class="form-group">
            <label for="login"><?= self::get('MonCompte', 'Libelle', 'NomDeCompte') ?></label>
            <input id="login" type="text" class="form-control" name="login" value="<?=$_SESSION['util']->getLogin()?>" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="mdp"><?= self::get('MonCompte', 'Libelle', 'MotDePasse') ?></label>
            <input id="mdp" type="password" class="form-control" name="mdp"
                placeholder="<?= self::get('MonCompte', 'Placeholder', 'NewMotDePasse') ?>">
        </div>
        <div class="form-group">
            <label for="email"><?= self::get('MonCompte', 'Libelle', 'EMail') ?></label>
            <input id="email" type="email" class="form-control" name="email" value="<?=$_SESSION['util']->getEmail()?>">
        </div>
        <input type="submit" name="submit" value="<?= self::get('MonCompte', 'Bouton', 'Modifier') ?>" class="btn mon-btn">
    </form>
</div>