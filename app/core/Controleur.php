<?php
    namespace GeoVilles\Core;

    /**
     * Classe du contrôleur par défaut, tous les contrôleurs doivent hériter
     * de cette classe.
     * @package GeoVilles\Core
     */
    abstract class Controleur {

        /** @var string le titre de la page. */
        private $titre;

        /** @var string l'onglet actif dans le menu. */
        private $active;

        /**
         * Créé un nouveau contrôleur.
         */
        public function __construct() {
            session_start();
            $this->titre = 'Géo Villes';
        }

        /**
         * Méthode lancée par défaut sur un contrôleur.
         */
        public abstract function index();

        /**
         * @return string le titre de la page.
         */
        public function getTitre() {
            return $this->titre;
        }

        /**
         * Modifie le titre de la page.
         * @param $titre string le titre de la page.
         */
        protected function setTitre($titre) {
            $this->titre .= ' - ' . $titre;
        }

        /**
         * Modifie la page active dans le menu.
         * @param $activePage string la page active.
         */
        protected function setActivePage($activePage) {
            $this->active = $activePage;
        }
    }