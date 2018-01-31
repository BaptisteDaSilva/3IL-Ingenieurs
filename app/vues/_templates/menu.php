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
			<a class="navbar-brand" href="/"> <img
				src="<?= IMAGES . 'ico.png' ?>">&nbsp;&nbsp;&nbsp;<?= self::getTitreSite() ?>
			</a>
		</div>
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li <?php if ($this->getActivePage() == 'Accueil') { echo 'class="active"'; } ?>><a href="/"> <i
						class="fa fa-home"></i>&nbsp;&nbsp;Accueil <span class="sr-only">
							(current)</span></a>
				</li>
				<li class="dropdown <?php if ($this->getActivePage() == 'Formation') { echo 'active'; } ?>">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-list"></i>&nbsp;&nbsp;Formation
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">                        
                        <li><a href="/Formation"><i class="fa fa-plus"></i>&nbsp;&nbsp;Présentation</a></li>
                        <li><a href="/Formation/annee1"><i class="fa fa-plus"></i>&nbsp;&nbsp;Année 1</a></li>
                        <li><a href="/Formation/annee2"><i class="fa fa-plus"></i>&nbsp;&nbsp;Année 2</a></li>
                        <li><a href="/Formation/annee3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Année 3</a></li> 
                    </ul>
                </li>
				<li <?php if ($this->getActivePage() == 'Apprentissage') { echo 'class="active"'; } ?>><a href="/Apprentissage"><i
						class="fa fa-file"></i>&nbsp;&nbsp;Apprentissage
				</a></li>
				<li <?php if ($this->getActivePage() == 'Rodez') { echo 'class="active"'; } ?>><a href="/Rodez"><i
						class="fa fa-flag"></i>&nbsp;&nbsp;Rodez
				</a></li>
				<li <?php if ($this->getActivePage() == 'Contact') { echo 'class="active"'; } ?>><a href="/Contact"><i
						class="fa fa-pencil"></i>&nbsp;&nbsp;Contact
				</a></li>				
			</ul>
			<ul class="nav navbar-nav navbar-right">
			
                <?php if (isset($_SESSION['util'])) { ?>
                
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle login"
                           data-toggle="dropdown" role="button"
                           aria-haspopup="true"
                           aria-expanded="false">
                           <img class="profil"
                           src="<?= $_SESSION['util']->getAvatar() ?>">&nbsp;&nbsp;
                           <b><?= $_SESSION['util']->getLogin() ?>
                            </b><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/MonCompte"><i
                            class="fa fa-gears"></i>&nbsp;&nbsp;Mon Compte</a></li>
                            <li><a href="/Deconnexion"><i
                            class="fa fa-power-off"></i>&nbsp;&nbsp;Se
                            Déconnecter</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-plus"></i>&nbsp;&nbsp;S'Inscrire
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <form id="form-inscrire" class="form-inscrire" method="post"
                                           action="/Inscription">
                                    <div class="form-group">
                                        <input type="text" name="login"
                                               class="form-control" placeholder="Login"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="mdp"
                                               class="form-control"
                                               placeholder="Mot de Passe"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email"
                                               class="form-control" placeholder="Email"
                                               required>
                                    </div>
                                    <input type="submit" name="submit" class="btn
                                    mon-btn" disabled value="S'Inscrire">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;Se Connecter<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                <form class="form-connect" method="post"
                                  action="/Connexion">
                                    <div class="form-group">
                                        <input type="text" name="login"
                                               class="form-control"
                                               placeholder="Login" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control"
                                               name="mdp"
                                               placeholder="Mot de Passe" required>
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
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
		</div>
	</div>
</nav>