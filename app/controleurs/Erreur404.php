<?php

namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page d'erreur 404.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Erreur404 extends Controleur {
	
	/**
	 * Créé un nouveau contrôleur de la page d'accueil.
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Méthode lancée par défaut sur un contrôleur.
	 */
	public function index() {
		$this->setTitre ( 'Erreur 404' );
		
		require_once VUES . 'VueErreur404.php';
	}
}