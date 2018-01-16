<?php
    namespace GeoVilles\Modeles;

    /**
     * Représente un utilisateur du site connecté.
     * @package GeoVilles\Modeles
     */
    class Utilisateur extends Modele {

        /** Requête SQL permettant de vérifier qu'un utilisateur existe. */
        const RQT_CONNEXION_UTIL = 'SELECT login, mdp, email, type
                                    FROM t_utils
                                    WHERE login = :login
                                    AND mdp = :mdp';

        const RQT_PSEUDO = 'SELECT login
                            FROM t_utils
                            WHERE  login = :login';

        const RQT_AJOUTER_UTIL = 'INSERT INTO t_utils
                                  VALUES (:login, :mdp, :email, :type)';

        const RQT_MODIFIER_UTIL = 'UPDATE t_utils SET email = :email,
                                   mdp = :mdp
                                   WHERE login = :login';

        /** @var string le login de l'utilisateur. */
        private $login;

        /** @var string le mot de passe de l'utilisateur. */
        private $mdp;

        /** @var string l'eamil de l'utilisateur. */
        private $email;

        /**
         * @var string le type de l'utilisateur 'A' pour administrateur, 'C'
         * pour les autres.
         */
        private $type;

        /**
         * Créé un nouvel utilisateur.
         * @param string $login le login de l'utilisateur.
         * @param string $mdp le mot de passe de l'utilisateur.
         * @param string $email l'email de l'utilisateur.
         * @param string $type le type de l'utilisateur 'A' pour administrateur,
         * 'C' pour les autres.
         */
        public function __construct($login, $mdp, $email, $type) {
            $this->login = $login;
            $this->mdp = self::hashMdp($mdp);
            $this->email = $email;
            $this->type = $type;
        }

        public static function getUtilisateur($login, $mdp) {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_CONNEXION_UTIL);

            // Ajout des variables
            $requete->bindParam(':login', $login, \PDO::PARAM_STR);
            $requete->bindParam(':mdp', $mdp, \PDO::PARAM_STR);

            // Exécute la requête
            $requete->execute();

            // Sauvegarde la ligne retournée.
            $util = $requete->fetch();

            // Retourne l'utilisateur ou null s'il n'existe pas.
            return $util ? new Utilisateur($util->login,
                                            $util->mdp,
                                            $util->email,
                                            $util->type) : null;
        }

        public static function getPseudoUtil($login) {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_PSEUDO);

            // Ajout des variables
            $requete->bindParam(':login', $login, \PDO::PARAM_STR);

            // Exécute la requête
            $requete->execute();

            // Sauvegarde la ligne retournée.
            $login = $requete->fetch();

            // Retourne l'utilisateur ou null s'il n'existe pas.
            return $login;
        }

        /**
         * Crypte le mot de passe passé en argument selon l'algorithme
         * SHA 256.
         * @param $mdp string le mot de passe à crypter.
         * @return string le mot de passe crypté.
         */
        public static function hashMdp($mdp) {
            return hash('SHA256', $mdp);
        }

        public function insererBD() {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_AJOUTER_UTIL);

            // Exécution de la requête avec les paramètres.
            return $requete->execute(array(
                                         ':login' => $this->login,
                                         ':mdp' => $this->mdp,
                                         ':email' => $this->email,
                                         ':type' => $this->type
                                     ));
        }

        public function modifierUtil($email, $mdp) {
            // Connexion à la base
            self::connexionBD();

            // Prépare la requête
            $requete = self::getBaseDeDonnees()->getCnxBD()->prepare
            (self::RQT_MODIFIER_UTIL);

            return $requete->execute(array(
                                         ':login' => $this->login,
                                         ':mdp' => $mdp,
                                         ':email' => $email
                                     ));
        }

        /**
         * @return string le login de l'utilisateur.
         */
        public function getLogin() {
            return $this->login;
        }

        public function getMdp() {
            return $this->mdp;
        }

        /**
         * @return string l'email de l'utilisateur.
         */
        public function getEmail() {
            return $this->email;
        }

        /**
         * @return string le type de l'utilisateur 'A' pour administrateur, 'C'
         * pour les autres.
         */
        public function getType() {
            return $this->type;
        }
    }