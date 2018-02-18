<?php
use Rodez_3IL_Ingenieurs\Core\Application;

require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default bigPanel">
                <div class="panel-heading panel-navigation">
                    <h3 class="panel-title">Formation</h3>
                </div>
                <div style="text-align: center">
                	<a href="/Formation/annee1">
                    	&nbsp;&nbsp;<?= Application::$site->{'Menu'}->{'Form'}->{'Annee1'} ?>&nbsp;&nbsp;
                    </a>
                                           
                    <a href="/Formation/annee2">
                    	&nbsp;&nbsp;<?= Application::$site->{'Menu'}->{'Form'}->{'Annee2'} ?>&nbsp;&nbsp;
                    </a>
                    
                    <a href="/Formation/annee3">
                    	&nbsp;&nbsp;<?= Application::$site->{'Menu'}->{'Form'}->{'Annee3'} ?>&nbsp;&nbsp;
                    </a>
                 </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>