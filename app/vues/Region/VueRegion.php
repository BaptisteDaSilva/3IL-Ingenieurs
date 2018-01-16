<?php
    require_once TEMPLATES . 'enTete.php';
    require_once TEMPLATES . 'menu.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="panel panel-default bigPanel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->region->getNomReg()
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
                                    <?= $this->region->getNumReg() ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Chef-lieu</h3>
                                </div>
                                <div class="panel-body">
                                    <a href="/GeoVilles/ville/details/<?=
                                        $this->region->getChefLieu()
                                            ->getNumInsee()
                                    ?>"><?= $this->region->getChefLieu()->getNom() ?></a>
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
                                        if ($this->region->getDesc() == null) {
                                            echo '<i>Pas de description.</i>';
                                        } else {
                                            echo $this->region->getDesc();
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
                                    <h3 class="panel-title">Départements de
                                        la région
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Numéro</td>
                                                <td>Nom</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            for ($i = 0 ; $i < count
                                            ($this->region->getDeps()) ;
                                                 $i++) {
                                                echo '<tr>';
                                                echo '<td>' .
                                                     $this->region->getDeps()
                                                     [$i]->getNumDep() .
                                                     '</td>';
                                                echo '<td><a
                                                href="/GeoVilles/departement/details/' .
                                                     $this->region->getDeps()
                                                     [$i]->getNumDep() .
                                                     '">' .
                                                     $this->region->getDeps()
                                                     [$i]->getNom() .
                                                     '</a></td>';
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
        <div class="col-md-2">

        </div>
    </div>
</div>