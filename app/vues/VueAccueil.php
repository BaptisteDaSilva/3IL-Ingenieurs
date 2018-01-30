<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>

<div class="container">
	<div class="jumbotron">
		<h1>Bienvenue sur 3IL-Ingénieurs !</h1>
		<p>Ecole d'ingénieur en informatique à Rodez</p>
	</div>
	<?php
	
	
	if($dossier = opendir(PHOTOS))
	{	
	    echo '<div id="wrapper"><div class="rslides_container"><ul class="rslides" id="slider1">';
	    
	    while(false !== ($photos = readdir($dossier)))
	    {
	        if($photos != '.' && $photos != '..') {
	            echo '<li><img src="' . PHOTOS . $photos . '" alt=""><p class="caption">' . substr($photos, 0, stripos ( $photos , '.')) . '</p></li>';
	        }
	    }
	    
	    echo '</ul></div></div>';
    }
    
    
    echo '<div><h1>Liste des messages de la BD :</h1><ul>';
        
    foreach ($this->lesMess as $mess) {
        echo '<li>' . $mess->getIdMessage() . ' = ' . $mess->getLeMessage() . '</li>';
    }    
    
    echo '</ul></div>';    
	?>
</div>
