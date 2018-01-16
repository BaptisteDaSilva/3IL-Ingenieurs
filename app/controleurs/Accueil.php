<?php
    namespace GeoVilles\Controleurs;
    use GeoVilles\Core\Controleur;
    use GeoVilles\Modeles\Utilisateur;

    /**
     * Contrôleur de la page d'accueil du site.
     * @package GeoVilles\Controleurs
     */
    class Accueil extends Controleur {

        /**
         * Créé un nouveau contrôleur de la page d'accueil.
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Méthode lancée par défaut sur un contrôleur.
         */
        public function index() {
            $this->setTitre('Accueil');
            require_once VUES . 'VueAccueil.php';
        }
    }