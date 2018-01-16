<?php
    require_once TEMPLATES . 'enTete.php';
    require_once TEMPLATES . 'menu.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-default bigPanel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mon Compte</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form method="post"
                                      action="/GeoVilles/monCompte/modifier/">
                                    <div class="form-group">
                                        <label for="login">Login :</label>
                                        <input id="login" type="text"
                                               class="form-control"
                                               name="login" value="<?=
                                            $_SESSION['util']->getLogin() ?>" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="mdp">Mot de passe
                                            :</label>
                                        <input id="mdp" type="password"
                                               class="form-control"
                                               name="mdp"
                                               placeholder="Nouveau Mot de Passe">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email :</label>
                                        <input id="email" type="email"
                                               class="form-control"
                                               name="email" value="<?=
                                            $_SESSION['util']->getEmail() ?>">
                                    </div>
                                    <input type="submit" name="submit"
                                           value="Modifier" class="btn mon-btn">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>