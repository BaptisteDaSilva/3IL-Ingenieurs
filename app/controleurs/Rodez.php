<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page de présentation de Rodez.
 * 
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Rodez extends Controleur
{
    /**
     * Créé un nouveau contrôleur de la page de présentation de Rodez.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Rodez');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre('Rodez');
        
        require_once VUES . 'Rodez/VueRodez.php';
    }
}