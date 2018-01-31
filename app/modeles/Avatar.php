<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

/**
 * Représente un avatar.
 * 
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Avatar extends Modele
{
    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_LIST_AVATAR = 'SELECT idAvatar, nom
                             FROM t_avatar';
    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_NOM_AVATAR = 'SELECT nom
                            FROM t_avatar
                            WHERE idAvatar = :idAvatar';
    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_ID_AVATAR = 'SELECT idAvatar
                            FROM t_avatar
                            WHERE nom = :nom';

    /** @var int l'identifiant de l'image. */
    private $idAvatar;

    /** @var string le nom de l'image. */
    private $nom;
    
    /**
     * Créé une nouvelle avatar.
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
    
    public static function getNomAvatar($idAvatar)
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
        return $avatar ? $avatar->nom : null;
    }
}