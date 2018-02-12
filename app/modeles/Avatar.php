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
                             FROM t_avatars';

    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_NOM_AVATAR = 'SELECT nom
                            FROM t_avatars
                            WHERE idAvatar = :idAvatar';

    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_ID_AVATAR = 'SELECT idAvatar
                            FROM t_avatars
                            WHERE nom = :nom';

    const RQT_AJOUTER_AVATAR = 'INSERT INTO t_avatars (nom) VALUES (:nom)';

    const RQT_SUPPRIMER_AVATAR = 'DELETE FROM t_avatars WHERE idAvatar = :idAvatar';

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

    /**
     * TODO ecrire
     * 
     * @return NULL|Avatar TODO ecrire
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
     * TODO ecrire
     * 
     * @param string $nomAvatar
     *            TODO ecrire
     * @return NULL|string TODO ecrire
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
     *  TODO ecrire
     * @param string $idAvatar TODO ecrire
     * @return NULL|Avatar TODO ecrire
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
     *  TODO ecrire
     * @param Avatar $avatar TODO ecrire
     */
    public function ajouter($avatar)
    {
        if (self::insererBD()) {
            self::ajouterFichiers($avatar);
        }
    }

    /**
     *  TODO ecrire
     * @return boolean TODO ecrire
     */
    private function insererBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_AJOUTER_AVATAR);
        var_dump($requete);
        
        // Ajout des variables
        $requete->bindParam(':nom', $this->nom, \PDO::PARAM_STR);
        
        // Exécution de la requête avec les paramètres.
        return $requete->execute();
    }

    /**
     *  TODO ecrire
     * @param string $avatar TODO ecrire
     */
    private function ajouterFichiers($avatar)
    {
        move_uploaded_file($avatar, '../public/img/avatar/' . $this->nom);
    }

    /**
     *  TODO ecrire
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
     *  TODO ecrire
     * @return NULL|array TODO ecrire
     */
    private function supprimerBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_SUPPRIMER_AVATAR);
        
        var_dump($this);
        
        // Ajout des variables
        $requete->bindParam(':idAvatar', $this->idAvatar, \PDO::PARAM_INT);
        
        // Exécution de la requête.
        if (! $requete->execute()) {
            return $requete->errorInfo();
        }
        
        return null;
    }

    /**
     *  TODO ecrire
     */
    private function supprimerFichiers()
    {
        unlink(AVATAR . $this->nom);
    }

    /**
     *  TODO ecrire
     * @return string TODO ecrire
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * {@inheritDoc}
     * @see \Rodez_3IL_Ingenieurs\Modeles\Modele::getId()
     */
    public function getId()
    {
        return $this->idAvatar;
    }
}