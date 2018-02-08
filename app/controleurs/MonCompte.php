<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;

class MonCompte extends Controleur
{

    /** @var bool */
    private $modifOK;

    public $langues;

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        if (isset($_SESSION['util'])) {
            $this->setTitre("Mon Compte");
            
            require_once VUES . 'MonCompte/VueMonCompte.php';
        } else {
            header('Location: /Rodez_3IL_Ingenieurs/');
        }
    }

    public function modifier()
    {
        if (isset($_POST['email']) && isset($_POST['mdp'])) {
            $this->modifOK = true;
            
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            
            if (! empty($mdp)) {
                $mdp = Utilisateur::hashMdp($mdp);
                
                if ($_SESSION['util']->getMdp() != $mdp) {
                    $this->modifOK = $_SESSION['util']->modifierMDP($mdp);
                }
            }
            
            if (! empty($email) && $_SESSION['util']->getEmail() != $email) {
                $this->modifOK = $_SESSION['util']->modifierEMail($email);
            }
            
            $this->setTitre($this->modifOK ? "Modification Réussie !" : "Un Problème est survenue");
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    public function modifierAvatar()
    {
        if (isset($_POST['nomAvatar'])) {
            $nomAvatar = $_POST['nomAvatar'];
            
            $this->modifOK = $_SESSION['util']->modifierAvatar($nomAvatar);
            
            $this->setTitre($this->modifOK ? "Modification Réussie !" : "Un Problème est survenue");
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    public function modifierLangue()
    {
        if (isset($_POST['nomLangue'])) {
            $maLangue = $_POST['nomLangue'];
            
            $this->modifOK = $_SESSION['util']->modifierLangue($maLangue);
            
            $this->setTitre($this->modifOK ? "Modification Réussie !" : "Un Problème est survenue");
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    public function SousMenu($nom)
    {
        if ($nom == "Langue" || $nom == "AdminLangue") {
            $langues = Langue::getLangues();
        }
        
        if (substr($nom, 0, 5 === "Admin")) {
            if ($_SESSION['util']->isAdmin()) {
                header('Location: /MonCompte/');
                
                return;
            }
        }
        
        require VUES . 'MonCompte/SousMenu/' . $nom . '.php';
    }
}