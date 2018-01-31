<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page de deconnexion.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Deconnexion extends Controleur
{
    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        // Détruit la session courante.
        session_unset();
        session_destroy();
        
        header("refresh:5;url=/");
        
        $this->setTitre("Déconnexion");
        
        require_once VUES . 'Deconnexion/VueDeconnexion.php';
    }
}