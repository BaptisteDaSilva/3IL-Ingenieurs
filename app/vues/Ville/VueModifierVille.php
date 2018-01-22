<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>

<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKF71xDr7FUYEnAPfEIDz4VH1mdZ6nG2Y&signed_in=true&libraries=places&callback=initMap"
	async defer></script>
<script src="<?= JS ?>googleMap.js"></script>

<div class="container-fluid">
	<div class="row">
		<form method="post"
			action="/Rodez_3IL_Ingenieurs/ville/modifierRes/<?= $this->ville->getNumInsee() ?>/">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default bigPanel">
					<div class="panel-heading">
						<h3 class="panel-title"><?= $this->ville->getNom() ?>
                            <input type="submit"
								class="btn
                                         mon-btn-success"
								value="Valider">
						</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Numéro INSEE</h3>
									</div>
									<div class="panel-body">
                                        <?= $this->ville->getNumInsee() ?>
                                    </div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Code Postal</h3>
									</div>
									<div class="panel-body">
                                        <?= $this->ville->getCp() ?>
                                    </div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Département</h3>
									</div>
									<div class="panel-body">
										<a
											href="/Departement/details/<?=$this->ville->getDep()->getNumDep()?>"><?=$this->ville->getDep()->getNom()?></a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">
											Population<br>(en 2012)
										</h3>
									</div>
									<div class="panel-body">
										<input type="text" name="population" class="form-control"
											value="<?= $this->ville->getPopulation() ?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Densité</h3>
									</div>
									<div class="panel-body">
										<input type="text" name="densite" class="form-control"
											value="<?= $this->ville->getDensite() ?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Carte</h3>
									</div>
									<div class="panel-body">
										<div id="map" class="map"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Superficie</h3>
									</div>
									<div class="panel-body">
										<input type="text" name="superficie" class="form-control"
											value="<?= $this->ville->getSuperficie() ?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Altitude</h3>
									</div>
									<div class="panel-body">
										Min : <input type="text" name="altMin" class="form-control"
											value="<?=$this->ville->getAltMin()?>">
										Max : <input type="text" name="altMax" class="form-control"
											value="<?=$this->ville->getAltMax()?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Latitude</h3>
									</div>
									<div class="panel-body">
										<p id="lat">
											<input type="text" name="lat" class="form-control"
												value="<?= $this->ville->getLatitude() ?>">
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Longitude</h3>
									</div>
									<div class="panel-body">
										<p id="long">
											<input type="text" name="long" class="form-control"
												value="<?=$this->ville->getLongitude()?>">
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Description</h3>
									</div>
									<div class="panel-body">
                                        <?php
                                        if ($this->ville->getDesc() == null) {
                                            echo '<textarea name="desc" class="form-control"></textarea>';
                                        } else {
                                            echo '<textarea name="desc"
                                            class="form-control">' . $this->ville->getDesc() . '</textarea>';
                                        }
                                        ?>
                                    </div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Photos</h3>
									</div>
									<div class="panel-body">
										<div class="row">
                                            <?php
                                            for ($i = 0; $i < count($this->photosVille); $i ++) {
                                                echo '<div class="col-md-2">
                                                <a href="' . $this->photosVille[$i]->getChemin() . '"
                                                   class="thumbnail
                                                zoombox zgallery1" title="' . $this->photosVille[$i]->getNom() . '">
                                                    <img src="' . $this->photosVille[$i]->getChemin() . '" alt="' . $this->photosVille[$i]->getNom() . '">
                                                </a>
                                            </div>';
                                            }
                                            ?>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>