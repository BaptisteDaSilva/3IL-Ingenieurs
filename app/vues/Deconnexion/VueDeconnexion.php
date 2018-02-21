<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>
<script type="text/javascript">
var sec = 6;

$(document).ready(function() {
	document.getElementById("compteur").innerHTML=sec;
	setTimeout("compt()", 950);
});

function compt()
{
	sec -= 1;
    document.getElementById("compteur").innerHTML=sec;
    setTimeout("compt()", 950);
}
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-success bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= self::get('Deconnexion', 'TitreOk') ?></h3>
                </div>
                <div class="panel-body">
                    <?php if (self::isAdminConnect()) { ?>
                    <form method="post" action="/Administration/modifierTexte/Deconnexion/Texte">
                        <div class="form-group">
                            <textarea name="new" class="form-control" onchange="this.form.submit();"><?= self::get('Contact', 'Texte') ?></textarea>
                        </div>
                    </form>
                    <?php } else { ?>
                    <?= self::get('Deconnexion', 'Texte') ?>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once TEMPLATES . 'pied.php';
?>