<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

use Rodez_3IL_Ingenieurs\Libs\GestionFichier;

/**
 * Représente un avatar.
 *
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Avatar extends Modele
{

    /** @var string Requête SQL permettant de rechercher tous les avatars */
    const RQT_LIST_AVATAR = 'SELECT idAvatar, nom
                             FROM t_avatars';

    /** @var string Requête SQL permettant de rechercher le nom d'un avatar à partir de son identifiant */
    const RQT_NOM_AVATAR = 'SELECT nom
                            FROM t_avatars
                            WHERE idAvatar = :idAvatar';

    /** @var string Requête SQL permettant de rechercher l'identifiant d'un avatar à partir de son nom */
    const RQT_ID_AVATAR = 'SELECT idAvatar
                           FROM t_avatars
                           WHERE nom = :nom';

    /** @var string Requête SQL permettant de créer un avatar */
    const RQT_AJOUTER_AVATAR = 'INSERT INTO t_avatars (nom) VALUES (:nom)';

    /** @var string Requête SQL permettant de supprimer un avatar */
    const RQT_SUPPRIMER_AVATAR = 'DELETE FROM t_avatars WHERE idAvatar = :idAvatar';

    /** @var int l'identifiant de l'image. */
    private $idAvatar;

    /** @var string le nom de l'image. */
    private $nom;

    /**
     * Créer une nouvelle avatar.
     *
     * @param int $idAvatar
     *            l'identifiant de l'avatar.
     * @param string $nom
     *            le nom de l'avatar.
     */
    public function __construct($idAvatar, $nom)
    {
        $this->idAvatar = $idAvatar;
        $this->nom = $nom;
    }

    /**
     * Retourne tous les avatars présents en BD
     *
     * @return NULL|Avatar La liste des avatars si elle existe, null sinon
     */
    public static function getAvatars()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_LIST_AVATAR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $avatarBD = $requete->fetchAll();
        
        // Créé la liste des départements.
        for ($i = 0; $i < count($avatarBD); $i ++) {
            $avatars[$i] = new Avatar($avatarBD[$i]->idAvatar, $avatarBD[$i]->nom);
        }
        
        // Retourne la listes des départements.
        return isset($avatars) ? $avatars : null;
    }

    /**
     * Recherche l'identifiant d'un avatar à partir de son nom
     *
     * @param string $nomAvatar
     *            Nom de l'avatar à chercher
     * @return NULL|string L'id de l'avatar si il a été trouvé, null sinon
     */
    public static function getIdAvatar($nomAvatar)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_ID_AVATAR);
        
        // Ajout des variables
        $requete->bindParam(':nom', $nomAvatar, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $avatar = $requete->fetch();
        
        // Retourne l'utilisateur ou null s'il n'existe pas.
        return $avatar ? $avatar->idAvatar : null;
    }

    /**
     * Recherche un avatar à partir de son identifiant
     *
     * @param string $idAvatar
     *            L'identifiant de l'avatar
     * @return NULL|Avatar Avatar si trouvé, null sinon
     */
    public static function getAvatar($idAvatar)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_NOM_AVATAR);
        
        // Ajout des variables
        $requete->bindParam(':idAvatar', $idAvatar, \PDO::PARAM_INT);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $avatar = $requete->fetch();
        
        // Retourne l'utilisateur ou null s'il n'existe pas.
        return $avatar ? new Avatar($idAvatar, $avatar->nom) : null;
    }

    /**
     * Enregistre un nouvelle avatar dans la BD et sauvegarde l'image associé sur le serveur
     *
     * @param Avatar $avatar
     *            Nom de l'image associé à l'avatar
     */
    public function ajouter($avatar)
    {
        if (self::insererBD()) {
            self::ajouterImage($avatar);
        }
    }

    /**
     * Ajoute un nouvelle avatar dans la BD
     *
     * @return boolean True si insertion OK, false sinon
     */
    private function insererBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_AJOUTER_AVATAR);
        
        // Ajout des variables
        $requete->bindParam(':nom', $this->nom, \PDO::PARAM_STR);
        
        // Exécution de la requête avec les paramètres.
        return $requete->execute();
    }

    /**
     * Telecharge l'image de l'avatar sur le serveur
     *
     * @param string $avatar
     *            Nom de l'image de l'avatar
     */
    private function ajouterImage($avatar)
    {
        GestionFichier::telecharger(GestionFichier::$TYPE_AVATAR, $avatar, $this->nom);
    }

    /**
     * Supprime un avatar
     */
    public function supprimer()
    {
        $err = self::supprimerBD();
        
        if ($err == null) {
            self::supprimerFichiers();
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r($err->errorInfo());
        }
    }

    /**
     * Supprime l'avatar de la BD
     *
     * @return NULL|array Tableau d'erreur si problème, null sinon
     */
    private function supprimerBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_SUPPRIMER_AVATAR);
                
        // Ajout des variables
        $requete->bindParam(':idAvatar', $this->idAvatar, \PDO::PARAM_INT);
        
        // Exécution de la requête.
        if (! $requete->execute()) {
            return $requete->errorInfo();
        }
        
        return null;
    }

    /**
     * Supprimer l'image de l'avatar du serveur
     */
    private function supprimerFichiers()
    {
        GestionFichier::supprimer(GestionFichier::$TYPE_AVATAR, $this->nom);
    }

    /**
     *
     * @return string Le nom de l'avatar
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * {@inheritdoc}
     * @see \Rodez_3IL_Ingenieurs\Modeles\Modele::getId()
     */
    public function getId()
    {
        return $this->idAvatar;
    }
}