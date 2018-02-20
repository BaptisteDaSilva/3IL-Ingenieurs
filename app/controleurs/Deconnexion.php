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
        
        setcookie('3il-Ingenieurs-Util-nom', NULL, time() - 3600, null, null, false, true);
        setcookie('3il-Ingenieurs-Util-mdp', NULL, time() - 3600, null, null, false, true);
        
        unset($_COOKIE['3il-Ingenieurs-Util-nom']);
        unset($_COOKIE['3il-Ingenieurs-Util-mdp']);
        
        header("refresh:5;url=/");
        
        $this->setTitre($this->get('Deconnexion', 'Titre'));
        
        require_once VUES . 'Deconnexion/VueDeconnexion.php';
    }
}