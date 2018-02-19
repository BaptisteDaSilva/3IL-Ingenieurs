<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;

/**
 * Contrôleur de la page de connexion du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Connexion extends Controleur
{
    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        // Si le pseudo et le mot de passe transmit existent.
        if (isset($_POST['login']) && isset($_POST['mdp'])) {
            
            // On les sauvegarde
            $login = $_POST['login'];
            $mdp = Utilisateur::hashMdp($_POST['mdp']);
            
            // Connexion à la base de donnée et vérifcation de l'utilisateur.
            $util = Utilisateur::getConnexion($login, $mdp);
            
            // Si l'utilisateur est correct.
            if ($util != null) {
                
                // Créé la variable de session de l'utilisateur.
                $_SESSION['util'] = $util;
                
                if (substr($_SERVER['HTTP_REFERER'], - strlen("Deconnexion")) === "Deconnexion") {
                    header('Location: /');
                } else {
                    // Rafraîchi la page
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                
                // Edition du titre de la page
                $this->setTitre($this->get('Formation', 'TitreKO'));
                
                /*
                 * Si l'utilisateur n'existe pas dans la base de donnée,
                 * affiche une page d'erreur.
                 */
                require_once VUES . 'Connexion/VueConnexionEchec.php';
            }
        }
    }
}