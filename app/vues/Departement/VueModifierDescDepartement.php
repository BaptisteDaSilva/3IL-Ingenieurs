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
					<h3 class="panel-title"><?= $this->dep->getNom() ?></h3>
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
										href="/3IL-Ingenieurs/region/details/<?=$this->dep->getRegion()->getNumReg()?>"><?= $this->dep->getRegion()->getNomReg() ?></a>
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
										href="/3IL-Ingenieurs/ville/details/<?=$this->dep->getChefLieu()->getNumInsee()?>"><?= $this->dep->getChefLieu()->getNom() ?></a>
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
									<form method="post"
										action="/Rodez_3IL_Ingenieurs/departement/modifDep/<?= $this->dep->getNumDep() ?>">
										<div class="form-group">
                                    <?php
                                    if ($this->dep->getDesc() == null) {
                                        echo '<textarea name="desc" class="form-control"></textarea>';
                                    } else {
                                        echo '<textarea name="desc"
                                            class="form-control">' . $this->dep->getDesc() . '</textarea>';
                                    }
                                    ?>
                                        </div>
										<input type="submit" name="submit" class="btn mon-btn"
											value="Modifier">
									</form>
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
                                                href="/3IL-Ingenieurs/ville/details/' . $this->dep->getVilles()[$i]->getNumInsee() . '">' . $this->dep->getVilles()[$i]->getNom() . '</a></td>';
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