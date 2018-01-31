<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page d'accueil du site.
 * 
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Accueil extends Controleur
{
    /**
     * Créé un nouveau contrôleur de la page d'accueil.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Accueil');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre('Accueil');
        
        require_once VUES . 'VueAccueil.php';
    }
}