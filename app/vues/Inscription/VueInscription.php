<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
            <?php if ($this->inscriptionOK) { ?>
                <div class="panel panel-success bigPanel">
				<div class="panel-heading">
					<h3 class="panel-title">Inscription : Réussie !</h3>
				</div>
				<div class="panel-body">
					Votre inscription s'est déroulée avec succès. <br> Vous pouvez
					maintenant vous connecter avec vos identifiants. <br> Merci.
				</div>
			</div>
            <?php } else { ?>
                <div class="panel panel-danger bigPanel">
				<div class="panel-heading">
					<h3 class="panel-title">Inscription : Echoué !</h3>
				</div>
				<div class="panel-body">
					Un problème est survenu lors de votre inscription. <br> Merci de
					réessayer de vous inscrire avec des identifiants différents.
				</div>
			</div>
            <?php } ?>
        </div>
		<div class="col-md-2"></div>
	</div>
</div>