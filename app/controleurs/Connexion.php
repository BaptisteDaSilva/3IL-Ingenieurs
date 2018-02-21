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
            
            // Connexion à la base de donnée et vérification de l'utilisateur.
            $util = Utilisateur::getConnexion($login, $mdp);
            
            // Si l'utilisateur est correct.
            if ($util != null) {
                // Créé la variable de session de l'utilisateur.
                $_SESSION['util'] = $util;
                
                if (isset($_POST['remember'])) {
                    setcookie('3il-Ingenieurs-Util-nom', $util->getLogin(), time() + 24 * 3600, null, null, false, true);
                    setcookie('3il-Ingenieurs-Util-mdp', $util->getMdp(), time() + 24 * 3600, null, null, false, true);
                }
                
                if (substr($_SERVER['HTTP_REFERER'], - strlen("Deconnexion")) === "Deconnexion") {
                    header('Location: /');
                } else {
                    // Rafraîchi la page
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                
                // Edition du titre de la page
                $this->setTitre($this->get('SeConnecter', 'TitreKO'));
                
                /*
                 * Si l'utilisateur n'existe pas dans la base de donnée,
                 * affiche une page d'erreur.
                 */
                require_once VUES . 'Connexion/VueConnexionEchec.php';
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}