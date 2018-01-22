<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;

class Inscription extends Controleur
{

    /** @var bool */
    private $inscriptionOK;

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['email'])) {
            $util = new Utilisateur($_POST['login'], $_POST['mdp'], $_POST['email'], 'C');
            
            $this->inscriptionOK = $util->insererBD();
        }
        
        require_once VUES . 'Inscription/VueInscription.php';
    }

    public function testPseudo($login)
    {
        if (isset($login)) {
            $pseudo = Utilisateur::getPseudoUtil($login);
            
            if ($pseudo != null) {
                header("HTTP/1.1 404 File Not Found");
            }
        }
    }
}