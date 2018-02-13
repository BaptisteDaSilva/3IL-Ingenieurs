<?php

namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Avatar;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;
use Rodez_3IL_Ingenieurs\Libs\Photo;

/**
 * Contrôleur de la page des pages d'administration du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Administration extends Controleur {
	
	/** @var bool */
	private $modifOK;
	
	/**
	 * Méthode lancée par défaut sur un contrôleur.
	 */
	public function index() {
		if (self::isAdminConnect ()) {
			header ( 'Location: /MonCompte/' );
		} else {
			header ( 'Location: /' );
		}
	}
	
	/**
	 * Méthode lancée pour créer ajouter un avatar
	 */
	public function ajouterAvatar() {
		if (self::isAdminConnect ()) {
			$avatar = new Avatar ( null, $_FILES ['avatar'] ['name'] );
			
			$avatar->ajouter ( $_FILES ['avatar'] ['tmp_name'] );
		}
		
		$this->menu = 'AdminAvatar'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour supprimer un avatar
	 */
	public function supprimerAvatar() {
		if (self::isAdminConnect ()) {
			foreach ( $_POST ['aSupp'] as $aSupp ) {
				Avatar::getAvatar ( $aSupp )->supprimer ();
			}
		}
		
		$this->menu = 'AdminAvatar'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour ajouter une langue
	 */
	public function ajouterLangue() {
		if (self::isAdminConnect ()) {
			$langue = new Langue ( $_POST ['id'], $_POST ['nom'] );
			
			$langue->ajouter ( $_FILES ['drapeau'] ['tmp_name'], $_FILES ['propertie'] ['tmp_name'] );
		}
		
		$this->menu = 'AdminLangue'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour supprimer une langue
	 */
	public function supprimerLangue() {
		if (self::isAdminConnect ()) {
			foreach ( $_POST ['aSupp'] as $aSupp ) {
				Langue::getLangue ( $aSupp )->supprimer ();
			}
		}
		
		$this->menu = 'AdminLangue'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour ajouter un administrateur
	 */
	public function ajouterAdmin() {
		if (self::isAdminConnect ()) {
			foreach ( $_POST ['aUp'] as $aUp ) {
				Utilisateur::getUtilisateur ( $aUp )->modifierType ( 'A' );
			}
		}
		
		$this->menu = 'AdminMembre'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour supprimer un administrateur
	 */
	public function supprimerAdmin() {
		if (self::isAdminConnect ()) {
			foreach ( $_POST ['aDown'] as $aDown ) {
				Utilisateur::getUtilisateur ( $aDown )->modifierType ( 'U' );
			}
		}
		
		$this->menu = 'AdminMembre'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour télécharger le fichier properties par defaut
	 */
	public function defaultProperties() {
		if (self::isAdminConnect ()) {
			$size = filesize ( DEFAUT_PROPERTIES );
			header ( "Content-Type: application/force-download; name=XX.json" );
			header ( "Content-Transfer-Encoding: binary" );
			header ( "Content-Length: $size" );
			header ( "Content-Disposition: attachment; filename=XX.json" );
			header ( "Expires: 0" );
			header ( "Cache-Control: no-cache, must-revalidate" );
			header ( "Pragma: no-cache" );
			readfile ( DEFAUT_PROPERTIES );
		} else {
			header ( 'Location: /MonCompte/' );
		}
	}
	
	/**
	 * Méthode lancée pour ajouter des photos au slider
	 */
	public function ajouterPhoto() {
		if (self::isAdminConnect ()) {
			$name = str_replace ( ' ', '', $_FILES ['photo'] ['name'] );
			
			move_uploaded_file ( $_FILES ['photo'] ['tmp_name'], '../public/img/photos/' . $name );
			
			Photo::addPhoto ( $name );
		}
		
		$this->menu = 'AdminPhoto'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour supprimer des photos du slider
	 */
	public function supprimerPhoto() {
		if (self::isAdminConnect ()) {
			
			foreach ( $_POST ['aSupp'] as $aSupp ) {
				unlink ( '../public/img/photos/' . $aSupp );
				
				Photo::deletePhoto ( $aSupp );
			}
		}
		
		$this->menu = 'AdminPhoto'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Méthode lancée pour modifier la description des photos du slider
	 */
	public function modifierDescriptionPhoto() {
		if (self::isAdminConnect ()) {
			foreach ( $_POST ['photos'] as $cle => $value ) {
				Photo::updateDescription ( $cle, $_POST ['idLangue'], $value );
			}
		}
		
		$this->menu = 'AdminDescriptionPhoto'; // TODO inutile
		
		header ( 'Location: /MonCompte/' );
	}
	
	/**
	 * Fonction permettant de savoir si un adminstrateur est connecté
	 */
	private static function isAdminConnect() {
		return isset ( $_SESSION ['util'] ) && $_SESSION ['util']->isAdmin ();
	}
}