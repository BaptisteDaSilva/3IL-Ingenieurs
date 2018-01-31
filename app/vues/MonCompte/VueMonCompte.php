<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>

<script>
function showMonCompte() {    
    document.getElementById("panel_monCompte").style.display = "block";
    document.getElementById("panel_monAvatar").style.display = "none";
}

function ShowMonAvatar() {
    document.getElementById("panel_monAvatar").style.display = "block";
    document.getElementById("panel_monCompte").style.display = "none";
}

$(function(){
	$('img').click(function(){
		   $('.selected').removeClass('selected'); // removes the previous selected class
		   $(this).addClass('selected'); // adds the class to the clicked image


		document.getElementById("nomAvatar").value = $('.selected')[0].alt;
	});
});
</script>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-default bigPanel">
				<div class="panel-heading panel_monCompte">
					<input type="button" value="Mon Compte" onclick="showMonCompte()"/>
					<input type="button" value="Mon avatar" onclick="ShowMonAvatar()"/>
				</div>
				<div id="panel_monCompte" class="panel-body">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<form method="post"
								action="/MonCompte/modifier/">
								<div class="form-group">
									<label for="login">Login :</label> <input id="login"
										type="text" class="form-control" name="login"
										value="<?=$_SESSION['util']->getLogin()?>"
										disabled>
								</div>
								<div class="form-group">
									<label for="mdp">Mot de passe :</label> <input id="mdp"
										type="password" class="form-control" name="mdp"
										placeholder="Nouveau Mot de Passe">
								</div>
								<div class="form-group">
									<label for="email">Email :</label> <input id="email"
										type="email" class="form-control" name="email"
										value="<?=$_SESSION['util']->getEmail()?>">
								</div>
								<input type="submit" name="submit" value="Modifier"
									class="btn mon-btn">
							</form>
						</div>
					</div>
				</div>
				<div id="panel_monAvatar" class="panel-body" style="display: none">
					<form method="post" action="/MonCompte/modifierAvatar/">
						<input type="hidden" name="nomAvatar" id="nomAvatar" value="<?= $_SESSION['util']->getNomAvatar() ?>" />			
        				<?php
        				if($dossier = opendir('../public/img/avatar')) {
        				    while(false !== ($avatar = readdir($dossier))) {
        				        if($avatar != '.' && $avatar != '..' && $avatar != 'defaut.png') {
        				            if ($avatar == $_SESSION['util']->getNomAvatar()) {
        				                echo '<img class="selected" src="' . AVATAR . $avatar . '" alt=""/>'; 
        				            } else {
                    	               echo '<img src="' . AVATAR . $avatar . '" alt="' . $avatar . '"/>';  
                    	            }
                    	        }
                    	    }
                        }
                        ?>
                        <div>
    						<input type="submit" name="submitAvatar" value="Modifier" class="btn mon-btn">
    					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>