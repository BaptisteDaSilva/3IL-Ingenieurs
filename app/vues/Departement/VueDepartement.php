<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-default bigPanel">
				<div class="panel-heading">
					<h3 class="panel-title"><?= $this->dep->getNom() ?>
                        <?php
                        if (isset($_SESSION['util'])) {
                            echo '<a
                                href="Departement/modifierDes/' . $this->dep->getNumDep() . '/" class="btn mon-btn"><span class="fa fa-pencil-square-o"></span>&nbsp;&nbsp;Modifier</a>';
                        }
                        ?></h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Numéro</h3>
								</div>
								<div class="panel-body">
                                    <?= $this->dep->getNumDep() ?>
                                </div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Région</h3>
								</div>
								<div class="panel-body">
									<a
										href="/Region/details/<?=$this->dep->getRegion()->getNumReg()?>"><?= $this->dep->getRegion()->getNomReg() ?></a>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Chef-lieu</h3>
								</div>
								<div class="panel-body">
									<a
										href="Ville/details/<?=$this->dep->getChefLieu()->getNumInsee()?>"><?= $this->dep->getChefLieu()->getNom() ?></a>
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
                                    if ($this->dep->getDesc() == null) {
                                        echo '<i>Pas de description.</i>';
                                    } else {
                                        echo $this->dep->getDesc();
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
									<h3 class="panel-title">Villes du département</h3>
								</div>
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Numéro INSEE</th>
												<th>Nom</th>
											</tr>
										</thead>
										<tbody>
                                        <?php
                                        for ($i = 0; $i < count($this->dep->getVilles()); $i ++) {
                                            echo '<tr>';
                                            echo '<td>' . $this->dep->getVilles()[$i]->getNumInsee() . '</td>';
                                            echo '<td><a
                                                href="Ville/details/' . $this->dep->getVilles()[$i]->getNumInsee() . '">' . $this->dep->getVilles()[$i]->getNom() . '</a></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>