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
					<h3 class="panel-title">Résultats pour : "<?= $ville ?>"</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<tbody>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Numéro INSEE</th>
										<th>Nom</th>
									</tr>
								</thead>
								<tbody>
                            <?php
                            for ($i = 0; $i < count($this->villesRech); $i ++) {
                                echo '<tr>';
                                echo '<td>' . $this->villesRech[$i]->getNumInsee() . '</td>';
                                echo '<td><a
                                                href="/3IL-Ingenieurs/ville/details/' . $this->villesRech[$i]->getNumInsee() . '">' . $this->villesRech[$i]->getNom() . '</a></td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
							</table>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>