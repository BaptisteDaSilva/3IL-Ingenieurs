<?php
    namespace GeoVilles\controleurs;
    use GeoVilles\Core\Controleur;

    class Deconnexion extends Controleur{

        /**
         * Méthode lancée par défaut sur un contrôleur.
         */
        public function index() {
            // Détruit la session courante.
            session_unset();
            session_destroy();

            $this->setTitre("Déconnexion");

            require_once VUES . 'Deconnexion/VueDeconnexion.php';
        }
    }