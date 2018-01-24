<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page d'accueil du site.
 * 
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Formation extends Controleur
{
    /**
     * Créé un nouveau contrôleur de la page d'accueil.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Formation');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre('Formation');
        
        require_once VUES . 'Formation/VueFormation.php';
    }
    
    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function annee1()
    {
        $this->setTitre('Année 1');
        
        require_once VUES . 'Formation/VueAnnee1.php';
    }
    
    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function annee2()
    {
        $this->setTitre('Année 2');
        
        require_once VUES . 'Formation/VueAnnee2.php';
    }
    
    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function annee3()
    {
        $this->setTitre('Année 3');
        
        require_once VUES . 'Formation/VueAnnee3.php';
    }
}