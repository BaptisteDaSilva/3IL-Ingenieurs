<?php
    namespace GeoVilles\Modeles;

    /**
     * Classe représentant un département de France.
     * @package GeoVilles\modeles
     */
    class Departement extends Modele {

        /** Requête SQL permettant de récupérer les détails d'un département. */
        const RQT_DETAILS_DEPARTEMENTS = 'SELECT t_deps.numdep,
                                          t_deps.nom AS nomDep,
                                          t_villes.numinsee,
                                          t_villes.nom AS nomChefLieu,
                                          t_regions.numreg,
                                          t_regions.nom AS nomReg, t_deps.des
                                          FROM t_deps
                                          JOIN t_villes ON t_deps.cheflieu =
                                          t_villes.numinsee
                                          JOIN t_regions ON t_deps.region =
                                          t_regions.numreg
                                          WHERE t_deps.numdep = :numDep';

        /**
         * Requête SQL permettant de récupérer la liste des villes d'un
         * département.
         */
        const RQT_VILLE_DEPS = 'SELECT t_villes.numinsee, t_villes.nom
                                FROM t_villes
                                WHERE t_villes.dep = :numDep';

        const RQT_LISTE_DEPS = 'SELECT t_deps.numdep, t_deps.nom
                                FROM t_deps
                                ORDER BY t_deps.numdep';

        const RQT_MODIF_DEP = 'UPDATE t_deps
                               SET des = :desc
                               WHERE numdep = :numdep';

        /** @var string le numéro du département. */
        private $numDep;

        /** @var string le nom du département. */
        private $nom;

        /** @var Region la région du département. */
        private $region;

        /** @var Ville le chef-lieu du dpartement. */
        private $chefLieu;

        /** @var array la liste des villes du département. */
        private $villes;

        /** @var string la description du département. */
        private $desc;

        /**
         * Créé un département.
         * @param string $numDep le numéro du département.
         * @param string $nom le nom du département.
         * @param Region $region la région du département.
         * @param Ville $chefLieu le chef-lieu du dpartement.
         * @param array $villes la liste des villes du département.
         * @param string $desc la description du département.
         */
        public function __construct($numDep, $nom, Region $region = null,
            Ville $chefLieu = null, $villes = null ,$desc = null) {

            $this->numDep = $numDep;
            $this->nom = $nom;
            $this->region = $region;
            $this->chefLieu = $chefLieu;
            $this->villes = $villes;
            $this->desc = $desc;
        }

        /**
         * Récupère dans la base de données les détails d'un département.
         * @param $numDep string le numéro du département.
         * @return Departement|null le département ou null si ce département
         * n'existe pas dans la base de données.
         */
        public static function getDepartement($numDep) {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_DETAILS_DEPARTEMENTS);

            // Ajout des variables
            $requete->bindParam(':numDep', $numDep, \PDO::PARAM_STR);

            // Exécute la requête
            $requete->execute();

            // Sauvegarde la ligne retournée.
            $dep = $requete->fetch();

            // Récupère la liste des villes du département.
            $villes = self::getListeVilles($numDep);

            // Retourne le département ou null s'il n'existe pas.
            return $dep ? new Departement($dep->numdep, $dep->nomdep,
                                          new Region($dep->numreg, $dep->nomreg),
                                          new Ville($dep->numinsee,
                                                    $dep->nomcheflieu),
                                          $villes,
                                          $dep->des) : null;
        }

        /**
         * Récupère dans la base de données la liste des villes
         * du département.
         * @param $numDep string le numéro du département.
         * @return array la liste des villes du département.
         */
        private static function getListeVilles($numDep) {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_VILLE_DEPS);

            // Ajout des variables
            $requete->bindParam(':numDep', $numDep, \PDO::PARAM_STR);

            // Exécute la requête
            $requete->execute();

            // Sauvegarde la ligne retournée.
            $villesBD = $requete->fetchAll();

            // Créé la liste des villes.
            for ($i = 0 ; $i < count($villesBD) ; $i++) {
                $villes[$i] = new Ville($villesBD[$i]->numinsee,
                                        $villesBD[$i]->nom);
            }

            // Retourne la listes des villes.
            return isset($villes) ? $villes : null;
        }

        public static function getListeDepartements() {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_LISTE_DEPS);

            // Exécute la requête
            $requete->execute();

            // Sauvegarde la ligne retournée.
            $depsBD = $requete->fetchAll();

            for ($i = 0 ; $i < count($depsBD) ; $i++) {
                $deps[$i] = new Departement($depsBD[$i]->numdep,
                                            $depsBD[$i]->nom);
            }

            // Retourne la listes des villes.
            return isset($deps) ? $deps : null;
        }

        /**
         * @return string le numéro du département.
         */
        public function getNumDep() {
            return $this->numDep;
        }

        /**
         * @return string le nom du département.
         */
        public function getNom() {
            return $this->nom;
        }

        /**
         * @return Region la région du département.
         */
        public function getRegion() {
            return $this->region;
        }

        /**
         * @return Ville le chef-lieu du département.
         */
        public function getChefLieu() {
            return $this->chefLieu;
        }

        /**
         * @return array la liste des villes du département.
         */
        public function getVilles() {
            return $this->villes;
        }

        /**
         * @return string la description du département.
         */
        public function getDesc() {
            return $this->desc;
        }

        public static function setDesc($numDep, $desc) {

            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_MODIF_DEP);

            // Exécution de la requête avec les paramètres.
            return $requete->execute(array(
                                         ':desc' => $desc,
                                         ':numdep' => $numDep
                                     ));
        }
    }