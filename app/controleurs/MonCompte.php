<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;
use Rodez_3IL_Ingenieurs\Modeles\Avatar;

/**
 * Contrôleur des pages de gestion de son compte du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class MonCompte extends Controleur
{
    /** @var bool */
    private $modifOK;

    /** @var resource Listes des langues du site */
    public $langues;

    /** @var resource Listes des avatars du site */
    public $avatars;

    /** @var string Menu a affiché dans mon compte */
    public $menu = 'Compte';

    // TODO marche mais change pas
    
    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        if (isset($_SESSION['util'])) {
            $this->setTitre($this->get('MonCompte', 'Titre'));
            
            require_once VUES . 'MonCompte/VueMonCompte.php';
        } else {
            header('Location: /');
        }
    }

    /**
     * Méthode lancée pour afficher un des sous-menu de mon compte
     *
     * @param string $nom
     *            Nom du menu a affiché
     */
    public function SousMenu($nom)
    {
        if ($nom == "Langue") {
            $this->langues = Langue::getLangues();
        } else if ($nom == "Avatar") {
            $this->avatars = Avatar::getAvatars();
        }
        
        require VUES . 'MonCompte/SousMenu/' . $nom . '.php';
    }

    /**
     * Méthode lancée pour modifier son email et/ou mot de passe
     */
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
            
            $this->setTitre($this->get('MonCompte', $this->modifOK ? "TitreOK" : "TitreKO"));
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour modifier son avatar
     */
    public function modifierAvatar()
    {
        if (isset($_POST['nomAvatar'])) {
            $nomAvatar = $_POST['nomAvatar'];
            
            $this->modifOK = $_SESSION['util']->modifierAvatar($nomAvatar);
            
            $this->setTitre($this->get('MonCompte', $this->modifOK ? "TitreOK" : "TitreKO"));
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour modifier sa langue
     */
    public function modifierLangue()
    {
        if (isset($_POST['nomLangue'])) {
            $maLangue = $_POST['nomLangue'];
            
            $this->modifOK = $_SESSION['util']->modifierLangue($maLangue);
            
            $this->setTitre($this->get('MonCompte', $this->modifOK ? "TitreOK" : "TitreKO"));
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }
}