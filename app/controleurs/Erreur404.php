<?php
    namespace GeoVilles\Controleurs;
    use GeoVilles\Core\Controleur;

    /**
     * Contrôleur de la page d'erreur 404.
     * @package GeoVilles\Controleurs
     */
    class Erreur404 extends Controleur {

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
            echo 'Erreur404';
        }
    }