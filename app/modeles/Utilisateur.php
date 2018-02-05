<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

use Rodez_3IL_Ingenieurs\Core\Application;

/**
 * Représente un utilisateur du site connecté.
 * 
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Utilisateur extends Modele
{
    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_CONNEXION_UTIL = 'SELECT login, mdp, email, type, idAvatar, idLangue
                                    FROM t_utils
                                    WHERE login = :login
                                    AND mdp = :mdp';

    const RQT_PSEUDO = 'SELECT login
                            FROM t_utils
                            WHERE  login = :login';

    const RQT_AJOUTER_UTIL = 'INSERT INTO t_utils (login, mdp, email, type)
                                  VALUES (:login, :mdp, :email, :type)';

    const RQT_MODIFIER_MAIL_UTIL = 'UPDATE t_utils SET email = :email
                                   WHERE login = :login';
    
    const RQT_MODIFIER_MDP_UTIL = 'UPDATE t_utils SET mdp = :mdp
                                   WHERE login = :login';
    
    const RQT_MODIFIER_AVATAR_UTIL = 'UPDATE t_utils SET idAvatar = :idAvatar
                                   WHERE login = :login';
    
    const RQT_MODIFIER_LANGUE_UTIL = 'UPDATE t_utils SET idLangue = :idLangue
                                   WHERE login = :login';

    /** @var string le login de l'utilisateur. */
    private $login;

    /** @var string le mot de passe de l'utilisateur. */
    private $mdp;

    /** @var string l'eamil de l'utilisateur. */
    private $email;
    
    /**
     *
     * @var string le type de l'utilisateur 'A' pour administrateur, 'U'
     *      pour les autres.
     */
    private $type;

    /**
     * @var string le type de l'utilisateur 'A' pour administrateur, 'U'
     *      pour les autres.
     */
    private $idAvatar;
    
    /**
     * @var string le type de l'utilisateur 'A' pour administrateur, 'U'
     *      pour les autres.
     */
    private $idLangue;
    
    private static $TYPE_ADMIN = 'A';
    private static $TYPE_USER = 'U';
    
    /**
     * Créé un nouvel utilisateur.
     *
     * @param string $login
     *            le login de l'utilisateur.
     * @param string $mdp
     *            le mot de passe de l'utilisateur.
     * @param string $email
     *            l'email de l'utilisateur.
     */
    public function __construct($login, $mdp, $email, $type = "User", $idAvatar = null, $idLangue = null)
    {
        $this->login = $login;
        $this->mdp = self::hashMdp($mdp);
        $this->email = $email;
        $this->type = ($type = "User" ? self::$TYPE_USER : $type);   
        $this->idAvatar = $idAvatar;
        $this->idLangue = $idLangue;
    }

    public static function getUtilisateur($login, $mdp)
    {
        // Connexion à la base
        self::connexionBD();
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_CONNEXION_UTIL);
                
        // Ajout des variables
        $requete->bindParam(':login', $login, \PDO::PARAM_STR);
        $requete->bindParam(':mdp', $mdp, \PDO::PARAM_STR);
                
        // Exécute la requête
        $requete->execute();
                
        // Sauvegarde la ligne retournée.
        $util = $requete->fetch();
                
        // Retourne l'utilisateur ou null s'il n'existe pas.
        return $util ? new Utilisateur($util->login, $util->mdp, $util->email, $util->type, $util->idAvatar, $util->idLangue) : null;
    }

    public static function getPseudoUtil($login)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_PSEUDO);
        
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
     * 
     * @param $mdp string
     *            le mot de passe à crypter.
     * @return string le mot de passe crypté.
     */
    public static function hashMdp($mdp)
    {
        return hash('SHA256', $mdp);
    }

    public function insererBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_AJOUTER_UTIL);
        
        // Exécution de la requête avec les paramètres.
        return $requete->execute(array(
            ':login' => $this->login,
            ':mdp' => $this->mdp,
            ':email' => $this->email,
            ':type' => $this->type
        ));
    }
    
    public function modifierEMail($email)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_MODIFIER_MAIL_UTIL);
        
        $ok = $requete->execute(array(
            ':login' => $this->login,
            ':email' => $email
        ));
        
        if ($ok)
        {
            $this->email = $email;
        }
        
        return $ok;
    }
    
    public function modifierMDP($mdp)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_MODIFIER_MDP_UTIL);
        
        $ok = $requete->execute(array(
            ':login' => $this->login,
            ':mdp' => $mdp
        ));
        
        if ($ok)
        {
            $this->mdp = $mdp;
        }
        
        return $ok;
    }
    
    public function modifierUtil($email, $mdp)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_MODIFIER_UTIL);
        
        $ok = $requete->execute(array(
            ':login' => $this->login,
            ':mdp' => $mdp,
            ':email' => $email
        ));
        
        if ($ok)
        {
            $this->mdp = $mdp;
            $this->email = $email;
        }
        
        return $ok;
    }
    
    public function modifierAvatar($nomAvatar)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_MODIFIER_AVATAR_UTIL);
        
        $idAvatar = Avatar::getIdAvatar($nomAvatar);
        
        $ok = $requete->execute(array(
            ':login' => $this->login,
            ':idAvatar' => $idAvatar
        ));
        
        if ($ok)
        {
            $this->idAvatar = $idAvatar;
        }
        
        return $ok;
    }
    
    public function modifierLangue($nomLangue)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_MODIFIER_LANGUE_UTIL);
        
        $langue = Langue::getIdLangue($nomLangue);
                
        $ok = $requete->execute(array(
            ':login' => $this->login,
            ':idLangue' => $langue
        ));
        
        if ($ok)
        {
            $this->idLangue = $langue;
            
            Application::setPropertiesFile($nomLangue);
        }
        
        return $ok;
    }

    /**
     *
     * @return string le login de l'utilisateur.
     */
    public function getLogin()
    {
        return $this->login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     *
     * @return string l'email de l'utilisateur.
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return string le type de l'utilisateur 'A' pour administrateur, 'C'
     *         pour les autres.
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Créé un nouvel administrateur.
     */
    public function setAdministrateur()
    {
        $this->type = self::$TYPE_ADMIN;
    }
    
    /**
     *
     * @return string l'avatar de l'utilisateur.
     */
    public function getNomAvatar() 
    {
        $avatar = Avatar::getNomAvatar($this->idAvatar);
                
        return isset($avatar) ? $avatar : Avatar::$AVATAR_DEFAUT;
    }
    
    /**
     *
     * @return string l'avatar de l'utilisateur.
     */
    public function getLangue()
    {
        $langue = Langue::getLangue($this->idLangue);
        
        return isset($langue) ? $langue : null;
    }
}