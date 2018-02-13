<?php

namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;

/**
 * Contrôleur de la page d'inscription.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Inscription extends Controleur {
	
	/** @var bool */
	private $inscriptionOK;
	
	/**
	 * Méthode lancée par défaut sur un contrôleur.
	 */
	public function index() {
		if (isset ( $_POST ['login'] ) && isset ( $_POST ['mdp'] ) && isset ( $_POST ['email'] )) {
			$util = new Utilisateur ( $_POST ['login'], $_POST ['mdp'], $_POST ['email'] );
			
			$this->inscriptionOK = $util->insererBD ();
			
			if ($this->inscriptionOK) {
				$_SESSION ['util'] = $util;
			}
		}
		
		require_once VUES . 'Inscription/VueInscription.php';
	}
	
	/**
	 * Fonction permettant de savoir si un login est déjà
	 *
	 * @param string $login
	 *        	Pseudo de l'utilisateur
	 */
	public function testPseudo($login) {
		if (isset ( $login )) {			
			if (Utilisateur::getPseudoUtil ( $login )) {
				header ( 'HTTP/1.0 404 Not Found' );
			}
		}
	}
}