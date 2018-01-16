<?php
    namespace GeoVilles\controleurs;
    use GeoVilles\Core\Controleur;
    use GeoVilles\Modeles;

    require_once MODELES . 'Ville.php';
    require_once MODELES . 'Departement.php';
    require_once MODELES . 'Region.php';

    class Region extends Controleur {

        /** @var Modeles\Region */
        private $region;

        /**
         * Méthode lancée par défaut sur un contrôleur.
         */
        public function index() {
            // TODO: Implement index() method.
        }

        public function details($numReg) {
            if (isset($numReg)) {
                // Récupère les informations de la région.
                $this->region = Modeles\Region::getRegion($numReg);

                // Si la ville existe.
                if (isset($this->region)) {
                    // Affiche la page de la ville.
                    $this->setTitre($this->region->getNomReg());
                    require_once VUES . 'Region/VueRegion.php';
                } else {
                    // Affiche que la région n'existe pas.
                    $this->setTitre('Region Inconnue');
                    require_once VUES . 'Region/VueRegionErreur.php';
                }
            } else {
                header('Location: /GeoVilles/');
            }
        }

        public function carte() {
            $this->setTitre('Carte des régions');
            require_once VUES . 'Region/VueCarteRegion.php';
        }
    }