<?php
    namespace GeoVilles\Controleurs;

    use GeoVilles\Core\Controleur;
    use GeoVilles\Modeles;
    use GeoVilles\modeles\PhotoVille;

    require_once MODELES . 'Ville.php';
    require_once MODELES . 'Departement.php';
    require_once MODELES . 'PhotoVille.php';

    /**
     * Contrôleur gérant l'affichage des détails d'un ville.
     * @package GeoVilles\Controleurs
     */
    class Ville extends Controleur {

        /**
         * @var Modeles\Ville la ville dont on veut afficher les
         * informations.
         */
        private $ville;

        private $villesProches;

        /** @var array */
        private $photosVille;

        private $villesRech;

        /** @var bool */
        private $modifOK;

        /**
         * Méthode lancée par défaut sur un contrôleur.
         */
        public function index() {
            header('Location: /GeoVilles/');
        }

        /**
         * Affiche les détails d'une ville.
         * @param $numInsee string le numéro INSEE de la ville dont on veut
         * afficher les détails.
         */
        public function details($numInsee) {
            if (isset($numInsee)) {
                // Récupère les informations de la ville.
                $this->ville = Modeles\Ville::getVille($numInsee);

                // Si la ville existe.
                if (isset($this->ville)) {
                    // Affiche la page de la ville.
                    $this->setTitre($this->ville->getNom());
                    $this->villesProches = Modeles\Ville::getVillesProches
                    ($this->ville);
                    $config = parse_ini_file(CONFIG);
                    $nbPhotos = $config['nbPhotosVilles'];
                    $this->photosVille = PhotoVille::getPhotosVille
                    ($this->ville, $nbPhotos);
                    require_once VUES . 'Ville/VueVille.php';
                } else {
                    // Affiche que la ville n'existe pas.
                    $this->setTitre('Ville Inconnue');
                    require_once VUES . 'Ville/VueVilleErreur.php';
                }
            } else {
                header('Location: /GeoVilles/');
            }
        }

        public function ajoutPhoto($numInsee) {
            if (isset($numInsee)) {
                $dossier = PHOTOS_VILLES . $numInsee . '/';
                if (!file_exists($dossier)) {
                    mkdir($dossier, 0777, true);
                }

                $checkImage = getimagesize($_FILES['photo']['name']);

                if ($checkImage) {
                    if ($_FILES['photo']['size'] > 500000) {
                        // Fichier trop grand
                    }
                } else {
                    // Pas Image
                }
            }
        }

        public function rechercher() {
            if (isset($_POST['ville'])) {
                $ville = $_POST['ville'];
                $this->villesRech = Modeles\Ville::rechercherVille($ville);
                require_once VUES . 'Ville/VueResRecherche.php';
            }
        }

        public function modifier($numInsee) {
            if (isset($numInsee) && isset($_SESSION['util'])) {
                // Récupère les informations de la ville.
                $this->ville = Modeles\Ville::getVille($numInsee);

                // Si la ville existe.
                if (isset($this->ville)) {
                    // Affiche la page de la ville.
                    $this->setTitre($this->ville->getNom());
                    $config = parse_ini_file(CONFIG);
                    $nbPhotos = $config['nbPhotosVilles'];
                    $this->photosVille = PhotoVille::getPhotosVille
                    ($this->ville, $nbPhotos);
                    require_once VUES . 'Ville/VueModifierVille.php';
                } else {
                    // Affiche que la ville n'existe pas.
                    $this->setTitre('Ville Inconnue');
                    require_once VUES . 'Ville/VueVilleErreur.php';
                }
            } else {
                header('Location: /GeoVilles/');
            }
        }

        public function modifierRes($numInsee) {
            if (isset($numInsee) && isset($_POST['population']) && isset
                ($_POST['densite']) && isset($_POST['superficie']) && isset
                ($_POST['altMin']) && isset($_POST['altMax']) && isset
                ($_POST['long']) && isset($_POST['lat']) && isset
                ($_POST['desc'])) {

                $this->modifOK = Modeles\Ville::modifierVille($numInsee,
                                                   $_POST['population'],
                                             $_POST['densite'],
                                             $_POST['superficie'],
                                             $_POST['altMin'],
                                             $_POST['altMax'],
                                             $_POST['long'],
                                             $_POST['lat'],
                                             $_POST['desc']);

                require_once VUES . 'Ville/VueVilleResModifier.php';
            }
        }
    }