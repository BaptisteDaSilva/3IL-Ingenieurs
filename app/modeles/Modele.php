<?php

    namespace GeoVilles\Modeles;

    use GeoVilles\Libs\BaseDeDonnees;

    abstract class Modele {

        /** @var BaseDeDonnees la connexion à la base de données. */
        private static $baseDeDonnees;

        /**
         * Se connecte à la base de données.
         */
        protected static function connexionBD() {
            self::$baseDeDonnees = new BaseDeDonnees();
        }

        /**
         * @return BaseDeDonnees la connexion à la base de données.
         */
        protected static function getBaseDeDonnees() {
            return self::$baseDeDonnees;
        }
    }