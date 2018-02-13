<?php

namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur des pages de présentation de la formation.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Formation extends Controleur {
	
	/**
	 * Créé un nouveau contrôleur de la page d'accueil.
	 */
	public function __construct() {
		parent::__construct ();
		
		$this->setActivePage ( 'Formation' );
	}
	
	/**
	 * Méthode lancée par défaut sur un contrôleur.
	 */
	public function index() {
		$this->setTitre ( 'Formation' );
		
		require_once VUES . 'Formation/VueFormation.php';
	}
	
	/**
	 * Méthode lancée pour la page de présentation de la formation - Année 1.
	 */
	public function annee1() {
		$this->setTitre ( 'Année 1' );
		
		require_once VUES . 'Formation/VueAnnee1.php';
	}
	
	/**
	 * Méthode lancée pour la page de présentation de la formation - Année 2.
	 */
	public function annee2() {
		$this->setTitre ( 'Année 2' );
		
		require_once VUES . 'Formation/VueAnnee2.php';
	}
	
	/**
	 * Méthode lancée pour la page de présentation de la formation - Année 3.
	 */
	public function annee3() {
		$this->setTitre ( 'Année 3' );
		
		require_once VUES . 'Formation/VueAnnee3.php';
	}
}