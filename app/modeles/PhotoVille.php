<?php
    namespace GeoVilles\modeles;

    class PhotoVille extends Modele {

        const RQT_PHOTOS_VILLE = 'SELECT idphoto, nom, valeur
                                  FROM t_photos_villes
                                  WHERE ville = :numInsee
                                  ORDER BY valeur DESC
                                  LIMIT :nbPhotos';

        /** @var string l'identifiant de la photo. */
        private $id;

        /** @var string le nom de la photo. */
        private $nom;

        /** @var Ville */
        private $ville;

        /**
         * PhotoVille constructor.
         * @param string $id
         * @param string $nom
         * @param Ville $ville
         */
        public function __construct($id, $nom, $ville) {
            $this->id = $id;
            $this->nom = $nom;
            $this->ville = $ville;
        }

        /**
         * @param $ville Ville
         * @param $nbPhotos int
         * @return null
         */
        public static function getPhotosVille($ville, $nbPhotos) {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_PHOTOS_VILLE);

            $numInsee = $ville->getNumInsee();

            // Ajout des variables
            $requete->bindParam(':numInsee', $numInsee, \PDO::PARAM_STR);
            $requete->bindParam(':nbPhotos', $nbPhotos, \PDO::PARAM_INT);

            // Exécute la requête
            $requete->execute();

            // Sauvegarde la ligne retournée.
            $photosBD = $requete->fetchAll();

            // Créé la liste des départements.
            for ($i = 0 ; $i < count($photosBD) ; $i++) {
                $photos[$i] = new PhotoVille($photosBD[$i]->idphoto,
                                             $photosBD[$i]->nom,
                                             $ville);
            }

            // Retourne la listes des départements.
            return isset($photos) ? $photos : null;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getChemin() {
            return PHOTOS_VILLES . $this->ville->getNumInsee() . '/' .
                   $this->id . '.jpg';
        }
    }