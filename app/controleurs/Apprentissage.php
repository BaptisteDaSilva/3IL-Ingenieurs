<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page apprentissage du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Apprentissage extends Controleur
{

    /**
     * Créé un nouveau contrôleur de la page d'accueil.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Apprentissage');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre($this->get('Apprentissage', 'Titre'));
        
        require_once VUES . 'Apprentissage/VueApprentissage.php';
    }
}