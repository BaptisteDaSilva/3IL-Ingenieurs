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
            <?php if ($this->photos != null) { ?>
            <form method="post" action="/Administration/supprimerPhoto/">
                <div class="photos">                            
                <?php foreach ($this->photos as $photo) { ?>
                    <div class="photo">
                        <img src="<?= PHOTOS . $photo->nodeValue ?>" alt="<?= $photo->nodeValue ?>" />
                        <p>
                            <input id="supp<?= $photo->nodeValue ?>" type="checkbox" name="aSupp[]" value="<?= $photo->nodeValue ?>">
                            <label for="supp<?= $photo->nodeValue ?>"><?= $photo->nodeValue ?></label>
                        </p>
                    </div>
                <?php } ?>        
                </div>                             
                <div>
                    <input type="submit" name="submitLangue" value="Supprimer" class="btn mon-btn">
                </div>
            </form>
            <?php } ?> 
            <div class="panel-heading">
                <h3 class="panel-title">Ajouter :</h3>
            </div>
            <form method="post" action="/Administration/ajouterPhoto/" enctype="multipart/form-data">
                <div class="form-group">
                    <!-- div class="photoView">
                        <img id="photoView" src="<= PHOTOS . PHOTOS::$PHOTO_DEFAUT ?>" alt="Default image" class="photoView" />
                    </div -->
                    <input id="photo" type="file" class="form-control" name="photo" accept="image/*" required>
                </div>
                <input type="submit" name="submit" value="Ajouter" class="btn mon-btn">
            </form>
        </div>
    </div>
</div>