<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur des pages de présentation de la formation.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Formation extends Controleur
{

    /**
     * Créé un nouveau contrôleur de la page de formation.
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
        $this->setTitre($this->get('Formation', 'Titre'));
        
        require_once VUES . 'Formation/VueFormation.php';
    }
}