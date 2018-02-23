<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="<?= IMAGES . 'ico.png' ?>"> <?= self::get('Titre') ?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if ($this->getActivePage() == 'Accueil') { echo 'class="active"'; } ?>>
                    <a href="/">
                        <i class="fa fa-home"></i><?= self::get('Accueil', 'Titre') ?><span class="sr-only"> (current)</span>
                    </a>
                </li>
                <li <?php if ($this->getActivePage() == 'Formation') { echo 'class="active"'; } ?>>
                    <a href="/Formation">
                        <i class="fa fa-file"></i><?= self::get('Formation', 'Titre') ?>
                    </a>
                </li>
                <li <?php if ($this->getActivePage() == 'Apprentissage') { echo 'class="active"'; } ?>>
                    <a href="/Apprentissage">
                        <i class="fa fa-file"></i><?= self::get('Apprentissage', 'Titre') ?>
				    </a>
                </li>
                <li <?php if ($this->getActivePage() == 'Rodez') { echo 'class="active"'; } ?>>
                    <a href="/Rodez">
                        <i class="fa fa-flag"></i><?= self::get('Rodez', 'Titre') ?>
				    </a>
                </li>
                <li <?php if ($this->getActivePage() == 'Contact') { echo 'class="active"'; } ?>>
                    <a href="/Contact">
                        <i class="fa fa-pencil"></i><?= self::get('Contact', 'Titre') ?>
				    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (self::isMemberConnect()) { ?>
                <li class="dropdown <?php if ($this->getActivePage() == 'MonCompte') { echo 'active'; } ?>">
                    <a href="#" class="dropdown-toggle login" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img class="profil <?php if ($_SESSION['util']->isAdmin()) { echo 'admin'; } ?>"
                            src="<?= $_SESSION['util']->getLienAvatar() ?>">
                        <b><?= $_SESSION['util']->getLogin() ?></b>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/MonCompte">
                                <i class="fa fa-cog"></i><?= self::get('MonCompte', 'Titre') ?>
                            </a>
                        </li>
                        <?php if (self::isAdminConnect()) { ?>
                        <li>
                            <a href="/Administration">
                                <i class="fa fa-gears"></i><?= self::get('Administration', 'Titre') ?>
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="/Deconnexion">
                                <i class="fa fa-power-off"></i><?= self::get('Deconnexion', 'Titre') ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus"></i><?= self::get('SInscrire', 'Titre') ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form id="form-inscrire" class="form-inscrire" method="post" action="/Inscription">
                                <div class="form-group">
                                    <input type="text" name="login" class="form-control"
                                        placeholder="<?= self::get('MonCompte', 'Placeholder', 'NomDeCompte') ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="mdp" class="form-control"
                                        placeholder="<?= self::get('MonCompte', 'Placeholder', 'MotDePasse') ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="<?= self::get('MonCompte', 'Placeholder', 'EMail') ?>" required>
                                </div>
                                <input type="submit" name="submit" class="btn mon-btn" disabled value="<?= self::get('SInscrire', 'Bouton') ?>">
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i><?= self::get('SeConnecter', 'Titre') ?><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form class="form-connect" method="post" action="/Connexion">
                                <div class="form-group">
                                    <input type="text" name="login" class="form-control"
                                        placeholder="<?= self::get('MonCompte', 'Placeholder', 'NomDeCompte') ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="mdp"
                                        placeholder="<?= self::get('MonCompte', 'Placeholder', 'MotDePasse') ?>" required>
                                </div>
                                <div class="form-group">
                                    <input id="remember" type="checkbox" name="remember" class="checkbox-inline">
                                    <label for="remember"><?= self::get('SeConnecter', 'SeSouvenirDeMoi') ?></label>
                                </div>
                                <input type="submit" name="submit" class="btn mon-btn" value="<?= self::get('SeConnecter', 'Bouton') ?>">
                            </form>
                        </li>
                    </ul>
                </li>
             <?php } ?>
             </ul>
        </div>
    </div>
</nav>