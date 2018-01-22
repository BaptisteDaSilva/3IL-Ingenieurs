<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/3IL-Ingenieurs/"> <img
				src="<?= IMAGES . 'ico.png' ?>">&nbsp;&nbsp;&nbsp;<?= self::getTitreSite() ?>
			</a>
		</div>

		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="/3IL-Ingenieurs/"> <i
						class="fa fa-home"></i>&nbsp;&nbsp;Accueil <span class="sr-only">
							(current)</span></a></li>
				<li><a href="/3IL-Ingenieurs/region/carte/"> <i
						class="fa fa-map"></i>&nbsp;&nbsp;Carte des Régions
				</a></li>
				<li><a href="/3IL-Ingenieurs/departement/liste/"> <i
						class="fa fa-list"></i>&nbsp;&nbsp;Liste des Départements
				</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['util'])) {
                    echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle login"
                       data-toggle="dropdown" role="button"
                       aria-haspopup="true"
                       aria-expanded="false">
                       <img class="profil"
                       src="' . IMAGES . 'util-defaut.png">&nbsp;&nbsp;
                       <b>' . $_SESSION['util']->getLogin() . '
                        </b><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/3IL-Ingenieurs/monCompte/"><i
                        class="fa fa-gears"></i>&nbsp;&nbsp;Mon Compte</a></li>
                        <li><a href="/3IL-Ingenieurs/deconnexion/"><i
                        class="fa fa-power-off"></i>&nbsp;&nbsp;Se
                        Déconnecter</a></li>
                    </ul>
                </li>';
                } else {
                    echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-plus"></i>&nbsp;&nbsp;S\'Inscrire
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <form id="form-inscrire" class="form-inscrire" method="post"
                                       action="/Rodez_3IL_Ingenieurs/inscription/">
                                <div class="form-group">
                                    <input type="text" name="login"
                                           class="form-control" placeholder="Login"
                                           required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="mdp"
                                           class="form-control"
                                           placeholder="Mot de Passe"
                                           required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email"
                                           class="form-control" placeholder="Email"
                                           required="">
                                </div>
                                <input type="submit" name="submit" class="btn
                                mon-btn" disabled="" value="S\'Inscrire">
                            </form>
                        </li>
                    </ul>
                </li>';
                    echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-user"></i>&nbsp;&nbsp;Se Connecter
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <form class="form-connect" method="post"
                              action="/Rodez_3IL_Ingenieurs/connexion/">
                            <li>
                                <div class="form-group">
                                    <input type="text" name="login"
                                           class="form-control"
                                           placeholder="Login" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control"
                                           name="mdp"
                                           placeholder="Mot de Passe" required="">
                                </div>
                                <div class="form-group">
                                    <input id="remember" type="checkbox"
                                           name="remember"
                                           class="checkbox-inline"
                                           placeholder="remember">
                                    <label for="remember">Se Souvenir de moi</label>
                                </div>
                                <input type="submit" name="submit" class="btn
                                mon-btn" value="Se Connecter">
                            </li>
                        </form>
                    </ul>
                </li>';
                }
                ?>
            </ul>
		</div>
	</div>
</nav>