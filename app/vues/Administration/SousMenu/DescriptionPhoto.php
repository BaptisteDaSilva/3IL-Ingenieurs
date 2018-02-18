<?php use Rodez_3IL_Ingenieurs\Libs\Photo; ?>
<div id="panel_adminPhoto" class="panel-body panel-photo">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
												if ($this->photos != null) {
													if ($this->langues != null) {
														foreach ( $this->langues as $langue ) {
															?>
            <div class="panel-heading">
                <h3 class="panel-title"><?= $langue->getNom() ?></h3>
            </div>
            <form method="post" action="/Administration/modifierDescriptionPhoto/">
                <input type="hidden" name="idLangue" value="<?= $langue->getId() ?>" />
                <div class="photos">                            
                <?php foreach ($this->photos as $photo) { $pName = Photo::getName($photo); ?>
                    <div class="photo">
                        <img src="<?= PHOTOS . $pName ?>" alt="<?= $pName ?>" />
                        <input class="form-control" id="<?= $pName ?>" type="text" name="photos[<?= $pName ?>]" placeholder="Ajouter description"
                            value="<?= Photo::getDescription($pName, $langue->getId()) ?>" />
                    </div>
                <?php } ?>        
                </div>
                <div>
                    <input type="submit" name="submitLangue" value="Modifier" class="btn mon-btn">
                </div>
            </form>
            <?php
														}
													} else {
														echo "<p>Aucune langue n'est définis</p>";
													}
												} else {
													echo "<p>Aucune photo</p>";
												}
												?>
        </div>
    </div>
</div>
