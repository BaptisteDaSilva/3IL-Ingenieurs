<?php
require_once TEMPLATES . 'enTete.php';
require_once TEMPLATES . 'menu.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="panel panel-default bigPanel">
				<div class="panel-heading">
					<h3 class="panel-title">Liste des Départements</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Numéro</th>
								<th>Nom</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        for ($i = 0; $i < count($this->listeDeps); $i ++) {
                            echo '<tr>';
                            echo '<td>' . $this->listeDeps[$i]->getNumDep() . '</td>';
                            echo '<td><a
                                href="/3IL-Ingenieurs/departement/details/' . $this->listeDeps[$i]->getNumDep() . '">' . $this->listeDeps[$i]->getNom() . '</a></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>