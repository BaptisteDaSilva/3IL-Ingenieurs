<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>

<div class="container">
	<div class="jumbotron">
		<h1>Bienvenue sur 3il-Ingénieurs !</h1>
		<p>Ecole d'ingénieurs en informatique à Rodez</p>
	</div>
	<?php if($dossier = opendir('../public/img/photos')) { ?>
		<div id="slider">
			<a href="#slider" class="control_next">&gt;</a>
			<a href="#slider" class="control_prev">&lt;</a>
			<ul>
			<?php
    	    while(false !== ($photos = readdir($dossier))) {
    	        if($photos != '.' && $photos != '..') {
    	            echo '<li>
                            <img src="' . PHOTOS . $photos . '" alt="">
                            <p class="caption">' . substr($photos, 0, stripos ( $photos , '.')) . '</p>
                          </li>';
    	        }
    	    }
            ?>
			</ul>  
    	</div>
	<?php } ?>
</div>
