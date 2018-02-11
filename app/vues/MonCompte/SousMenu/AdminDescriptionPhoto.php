<!-- script type="text/javascript">
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#avatarView').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#avatar").change(function() {
  readURL(this);
});
</script -->
<div id="panel_adminPhoto" class="panel-body panel-photo">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
            if ($this->photos != null) {
                foreach ($this->langues as $langue) {
            ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?= $langue->getNom() ?></h3>
            </div>
            <form method="post" action="/Administration/modifierDescriptionPhoto/">
                <input type="hidden" name="idLangue" value="<?= $langue->getId() ?>"/>
                <div class="photos">                            
                <?php foreach ($this->photos as $photo) { ?>
                    <div class="photo">
                        <img src="<?= PHOTOS . $photo->nodeValue ?>" alt="<?= $photo->nodeValue ?>" />
                        <input class="form-control" id="<?= $photo->nodeValue ?>" type="text" name="photos[<?= $photo->nodeValue ?>]" placeholder="Description" value="<?= $doc->getElementById($langue->getId() . '_' . $photo->nodeValue)->nodeValue ?>"/>
                    </div>
                <?php } ?>        
                </div>                             
                <div>
                    <input type="submit" name="submitLangue" value="Modifier" class="btn mon-btn">
                </div>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>