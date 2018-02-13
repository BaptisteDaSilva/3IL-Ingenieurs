<?php

namespace Rodez_3IL_Ingenieurs\Modeles;

use Rodez_3IL_Ingenieurs\Core\Application;

/**
 * Représente un utilisateur du site connecté.
 *
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Utilisateur extends Modele {
	/**  @var string Requête SQL permettant de rechercher un utilisateur a partir de son login */
	const RQT_UTIL = 'SELECT login, mdp, email, type, idAvatar, idLangue
                       FROM t_utils
                       WHERE login = :login';
	
	/** @var string Requête SQL permettant de rechercher tous les utilisateurs d'un certain type */
	const RQT_UTIL_TYPE = 'SELECT login, mdp, email, type, idAvatar, idLangue
                       FROM t_utils
                       WHERE type = :type';
	
	/** @var string Requête SQL permettant de vérifier qu'un utilisateur existe */
	const RQT_CONNEXION_UTIL = 'SELECT login, mdp, email, type, idAvatar, idLangue
                                    FROM t_utils
                                    WHERE login = :login
                                    AND mdp = :mdp';
	
	/** @var string Requête SQL permettant de vérifier qu'un utilisateur existe */
	const RQT_PSEUDO = 'SELECT login
                            FROM t_utils
                            WHERE login = :login';
	
	/** @var string Requête SQL permettant de créer un utilisateur */
	const RQT_AJOUTER_UTIL = 'INSERT INTO t_utils (login, mdp, email, type)
                                  VALUES (:login, :mdp, :email, :type)';
	
	/** @var string Requête SQL permettant de modifier l'email d'un utilisateur */
	const RQT_MODIFIER_MAIL_UTIL = 'UPDATE t_utils SET email = :email
                                   WHERE login = :login';
	
	/** @var string Requête SQL permettant de modifier le mot de passe d'un utilisateur */
	const RQT_MODIFIER_MDP_UTIL = 'UPDATE t_utils SET mdp = :mdp
                                   WHERE login = :login';
	
	/** @var string Requête SQL permettant de modifier l'avatar d'un utilisateur */
	const RQT_MODIFIER_AVATAR_UTIL = 'UPDATE t_utils SET idAvatar = :idAvatar
                                   WHERE login = :login';
	
	/** @var string Requête SQL permettant de modifier la langue d'un utilisateur */
	const RQT_MODIFIER_LANGUE_UTIL = 'UPDATE t_utils SET idLangue = :idLangue
                                   WHERE login = :login';
	
	/** @var string Requête SQL permettant de modifier le type d'un utilisateur */
	const RQT_MODIFIER_TYPE_UTIL = 'UPDATE t_utils SET type = :type
                                   WHERE login = :login';
	
	/** @var string Login de l'utilisateur */
	private $login;
	
	/** @var string Mot de passe de l'utilisateur */
	private $mdp;
	
	/** @var string Eamil de l'utilisateur */
	private $email;
	
	/** @var string Type de l'utilisateur 'A' pour administrateur, 'U'  pour les autres */
	private $type;
	
	/** @var string Identifiant de l'avatar de l'utilisateur */
	private $idAvatar;
	
	/** @var string Identifiant de la langue de l'utilisateur */
	private $idLangue;
	
	/** @var string Type des utilisateurs de type Admin */
	private static $TYPE_ADMIN = 'A';
		
	/** @var string Type des utilisateurs */
	private static $TYPE_USER = 'U';
	
	/**
	 * Créé un nouvel utilisateur.
	 *
	 * @param string $login
	 *        	Login de l'utilisateur.
	 * @param string $mdp
	 *        	Mot de passe de l'utilisateur.
	 * @param string $email
	 *        	Email de l'utilisateur.
	 */
	public function __construct($login, $mdp, $email, $type = "User", $idAvatar = null, $idLangue = null) {
		$this->login = $login;
		$this->mdp = self::hashMdp ( $mdp );
		$this->email = $email;
		$this->type = ($type == "User" ? self::$TYPE_USER : $type);
		$this->idAvatar = $idAvatar;
		$this->idLangue = $idLangue;
	}
	
	/**
	 * Retourne la liste des Utilisateur
	 *
	 * @return Utilisateur La liste des utilisateurs 'Util' si il existe, null sinon
	 */
	public static function getUtilisateurs() {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_UTIL_TYPE );
		
		// Ajout des variables
		$requete->bindParam ( ':type', self::$TYPE_USER, \PDO::PARAM_STR );
		
		// Exécute la requête
		$requete->execute ();
		
		// Sauvegarde les lignes retournées.
		$utilBD = $requete->fetchAll ();
		
		// Créé la liste des départements.
		for($i = 0; $i < count ( $utilBD ); $i ++) {
			$utils [$i] = new Utilisateur ( $utilBD [$i]->login, $utilBD [$i]->mdp, $utilBD [$i]->email, $utilBD [$i]->type, $utilBD [$i]->idAvatar, $utilBD [$i]->idLangue );
		}
		
		// Retourne la listes des départements.
		return isset ( $utils ) ? $utils : null;
	}
	
	/**
	 * Retourne la liste des administateurs
	 *
	 * @return Utilisateur La liste des utilisateurs 'Admin' si il existe, null sinon
	 */
	public static function getAdministateurs() {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_UTIL_TYPE );
		
		// Ajout des variables
		$requete->bindParam ( ':type', self::$TYPE_ADMIN, \PDO::PARAM_STR );
		
		// Exécute la requête
		$requete->execute ();
		
		// Sauvegarde les lignes retournées.
		$adminBD = $requete->fetchAll ();
		
		// Créé la liste des départements.
		for($i = 0; $i < count ( $adminBD ); $i ++) {
			$admins [$i] = new Utilisateur ( $adminBD [$i]->login, $adminBD [$i]->mdp, $adminBD [$i]->email, $adminBD [$i]->type, $adminBD [$i]->idAvatar, $adminBD [$i]->idLangue );
		}
		
		// Retourne la listes des départements.
		return isset ( $admins ) ? $admins : null;
	}
	
	/**
	 * Recherche si un utilisateur existe à partir de son login
	 *
	 * @param string $login
	 *        	Login de l'utilisateur
	 * @return Utilisateur L'Utilisateur si il existe, null sinon
	 */
	public static function getUtilisateur($idUtil) {
		// Connexion à la base
		self::connexionBD ();
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_UTIL );
		
		// Ajout des variables
		$requete->bindParam ( ':login', $idUtil, \PDO::PARAM_STR );
		
		// Exécute la requête
		$requete->execute ();
		
		// Sauvegarde la ligne retournée.
		$util = $requete->fetch ();
		
		// Retourne l'utilisateur ou null s'il n'existe pas.
		return $util ? new Utilisateur ( $idUtil, $util->mdp, $util->email, $util->type, $util->idAvatar, $util->idLangue ) : null;
	}
	
	/**
	 * Recherche un utilisateur a partir de son login et mot de passe
	 *
	 * @param string $login
	 *        	Login de l'utilisateur
	 * @param string $mdp
	 *        	Mot de passe de l'utilisateur
	 * @return NULL|Utilisateur L'Utilisateur connecté
	 */
	public static function getConnexion($login, $mdp) {
		// Connexion à la base
		self::connexionBD ();
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_CONNEXION_UTIL );
		
		// Ajout des variables
		$requete->bindParam ( ':login', $login, \PDO::PARAM_STR );
		$requete->bindParam ( ':mdp', $mdp, \PDO::PARAM_STR );
		
		// Exécute la requête
		$requete->execute ();
		
		// Sauvegarde la ligne retournée.
		$util = $requete->fetch ();
		
		// Retourne l'utilisateur ou null s'il n'existe pas.
		return $util ? new Utilisateur ( $util->login, $util->mdp, $util->email, $util->type, $util->idAvatar, $util->idLangue ) : null;
	}
	
	/**
	 * Recherche si un utilisateur existe à partir de son login
	 *
	 * @param string $login
	 *        	Login de l'utilisateur
	 * @return Utilisateur L'Utilisateur si il existe, null sinon
	 */
	public static function getPseudoUtil($login) {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_PSEUDO );
		
		// Ajout des variables
		$requete->bindParam ( ':login', $login, \PDO::PARAM_STR );
		
		// Exécute la requête
		$requete->execute ();
		
		// Sauvegarde la ligne retournée.
		$login = $requete->fetch ();
		
		// Retourne l'utilisateur ou null s'il n'existe pas.
		return $login != null;
	}
	
	/**
	 * Crypte le mot de passe passé en argument selon l'algorithme SHA 256.
	 *
	 * @param $mdp string
	 *        	Le mot de passe à crypter.
	 * @return string Le mot de passe crypté.
	 */
	public static function hashMdp($mdp) {
		return hash ( 'SHA256', $mdp );
	}
	
	/**
	 * Ajoute un nouvelle utilisateur dans la BD
	 *
	 * @return boolean True si insertion OK, false sinon
	 */
	public function insererBD() {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_AJOUTER_UTIL );
		
		// Exécution de la requête avec les paramètres.
		return $requete->execute ( array (
				':login' => $this->login,
				':mdp' => $this->mdp,
				':email' => $this->email,
				':type' => $this->type 
		) );
	}
	
	/**
	 * Modifie l'email de l'utilisateur
	 *
	 * @param string $email
	 *        	Nouvel email de l'utilisateur
	 * @return boolean True si modification OK, false sinon
	 */
	public function modifierEMail($email) {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_MODIFIER_MAIL_UTIL );
		
		$ok = $requete->execute ( array (
				':login' => $this->login,
				':email' => $email 
		) );
		
		if ($ok) {
			$this->email = $email;
		}
		
		return $ok;
	}
	
	/**
	 * Modifie le mot de passe de l'utilisateur
	 *
	 * @param string $mdp
	 *        	Nouveau mot de passe de l'utilisateur
	 * @return boolean True si modification OK, false sinon
	 */
	public function modifierMDP($mdp) {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_MODIFIER_MDP_UTIL );
		
		$ok = $requete->execute ( array (
				':login' => $this->login,
				':mdp' => $mdp 
		) );
		
		if ($ok) {
			$this->mdp = $mdp;
		}
		
		return $ok;
	}
	
	/**
	 * Modfie l'avatar de l'utilisateur
	 *
	 * @param string $nomAvatar
	 *        	Nouveau nom de l'avatar
	 * @return boolean True si modification OK, false sinon
	 */
	public function modifierAvatar($nomAvatar) {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_MODIFIER_AVATAR_UTIL );
		
		$idAvatar = Avatar::getIdAvatar ( $nomAvatar );
		
		$ok = $requete->execute ( array (
				':login' => $this->login,
				':idAvatar' => $idAvatar 
		) );
		
		if ($ok) {
			$this->idAvatar = $idAvatar;
		}
		
		return $ok;
	}
	
	/**
	 * Change la langue de l'utilisateur
	 *
	 * @param string $nomLangue
	 *        	Nouvelle langue de l'utilisateur
	 * @return boolean True si modification OK, false sinon
	 */
	public function modifierLangue($nomLangue) {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_MODIFIER_LANGUE_UTIL );
		
		$langue = Langue::getIdLangue ( $nomLangue );
		
		$ok = $requete->execute ( array (
				':login' => $this->login,
				':idLangue' => $langue 
		) );
		
		if ($ok) {
			$this->idLangue = $langue;
			
			Application::setPropertiesFile ( $nomLangue );
		}
		
		return $ok;
	}
	
	/**
	 * Change le type de l'utilisateur
	 *
	 * @param string $type
	 *        	Nouveau type : 'A' pour administrateur, 'C' pour les autres.
	 * @return boolean True si modification OK, false sinon
	 */
	public function modifierType($type) {
		// Connexion à la base
		self::connexionBD ();
		
		// Prépare la requête
		$requete = self::getBaseDeDonnees ()->getCnxBD ()->prepare ( self::RQT_MODIFIER_TYPE_UTIL );
		
		$ok = $requete->execute ( array (
				':login' => $this->login,
				':type' => ($type == 'A' ? self::$TYPE_ADMIN : self::$TYPE_USER) 
		) );
		
		if ($ok) {
			$this->type = $type;
		}
		
		return $ok;
	}
	
	/**
	 * @return string Retourne le login de l'utilisateur.
	 */
	public function getLogin() {
		return $this->login;
	}
	
	/**
	 * @return string Retourne le mot de passe de l'utilisateur
	 */
	public function getMdp() {
		return $this->mdp;
	}
	
	/**
	 * @return string Retourne l'email de l'utilisateur
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @return string Retourne le type de l'utilisateur 'A' pour administrateur, 'C'
	 *         pour les autres.
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 *
	 * @return string Retourne le lien vers l'image de l'avatar
	 */
	public function getLienAvatar() {
		$avatar = Avatar::getAvatar ( $this->idAvatar );
		
		return isset ( $avatar ) ? AVATAR . $avatar->getNom () : DEFAUT_AVATAR;
	}
	
	/**
	 *
	 * @return string Retourne le nom de l'avatar
	 */
	public function getNomAvatar() {
		$avatar = Avatar::getAvatar ( $this->idAvatar );
		
		return isset ( $avatar ) ? $avatar->getNom () : null;
	}
	
	/**
	 *
	 * @return string Retourne le nom de la langue
	 */
	public function getNomLangue() {
		$langue = Langue::getLangue ( $this->idLangue );
		
		return isset ( $langue ) ? $langue->getNom () : null;
	}
	
	/**
	 *
	 * @return string Retourne la Langue de l'utilisateur
	 */
	public function getLangue() {
		$langue = Langue::getLangue ( $this->idLangue );
		
		return isset ( $langue ) ? $langue : null;
	}
	
	/**
	 *
	 * @return string Retourne true si l'Utilisateur est un amdin, false sinon
	 */
	public function isAdmin() {
		return $this->type == self::$TYPE_ADMIN;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 * @see \Rodez_3IL_Ingenieurs\Modeles\Modele::getId()
	 */
	public function getId() {
		return $this->login;
	}
}