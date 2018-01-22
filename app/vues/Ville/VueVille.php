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
		<div class="col-md-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Villes les plus proches</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<tbody>
                        <?php
                        for ($i = 0; $i < count($this->villesProches); $i ++) {
                            echo '<tr>';
                            echo '<td><a href="Ville/details/' . $this->villesProches[$i]->getNumInsee() . '">' . $this->villesProches[$i]->getNom() . '</a></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default bigPanel">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $this->ville->getNom() ?>
                        <?php
                        if (isset($_SESSION['util'])) {
                            echo '<a
                                href="Ville/modifier/' . $this->ville->getNumInsee() . '/" class="btn
                                     mon-btn"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Modifier</a>';
                        }
                        ?>
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
										href="Departement/details/<?=$this->ville->getDep()->getNumDep()?>"><?=$this->ville->getDep()->getNom()?></a>
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
                                    <?= $this->ville->getPopulation() ?> hab
                                </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Densité</h3>
								</div>
								<div class="panel-body">
                                    <?= $this->ville->getDensite() ?> hab/km²
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
                                    <?= $this->ville->getSuperficie() ?> km²
                                </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Altitude</h3>
								</div>
								<div class="panel-body">
                                    Min : <?= $this->ville->getAltMin() ?> m
                                    / Max : <?= $this->ville->getAltMax() ?>
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
                                        <?= $this->ville->getLatitude() ?></p>
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
                                        <?= $this->ville->getLongitude() ?></p>
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
                                        echo '<i>Pas de description.</i>';
                                    } else {
                                        echo $this->ville->getDesc();
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
	</div>
</div>