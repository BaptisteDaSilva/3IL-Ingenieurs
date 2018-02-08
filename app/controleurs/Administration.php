<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;

class Administration extends Controleur
{

    /** @var bool */
    private $modifOK;

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        // if (isset($_SESSION['util'])) {
        // $this->setTitre("Mon Compte");
        
        // require_once VUES . 'MonCompte/VueMonCompte.php';
        // } else {
        // header('Location: /Rodez_3IL_Ingenieurs/');
        // }
    }

    public function ajouterAvatar()
    {
        if ($_SESSION['util']->isAdmin()) {
            // TODO erire
        } else {
            header('Location: /MonCompte/');
        }
    }

    public function supprimerAvatar()
    {
        if ($_SESSION['util']->isAdmin()) {
            // TODO erire
        } else {
            header('Location: /MonCompte/');
        }
    }

    public function ajouterLangue()
    {
        if ($_SESSION['util']->isAdmin()) {
            $langue = new Langue(null, $_POST['nom'], $_FILES['drapeau']['name'], $_FILES['propertie']['name']);
            
            $langue->ajouter($_FILES['drapeau']['tmp_name'], $_FILES['propertie']['tmp_name']);
        } else {
            header('Location: /MonCompte/');
        }
    }

    public function supprimerLangue()
    {
        if ($_SESSION['util']->isAdmin()) {
            foreach ($_POST['aSupp'] as $aSupp) {
                Langue::getLangue($aSupp)->supprimer();
            }
        }
        
        // header('Location: /MonCompte/');
    }
}