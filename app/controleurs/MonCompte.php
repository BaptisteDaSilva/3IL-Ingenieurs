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
    private $modifOK = null;

    /** @var resource Listes des langues du site */
    public $langues;

    /** @var resource Listes des avatars du site */
    public $avatars;

    /** @var string Menu a affiché dans mon compte */
    public $MENU_DEFAUT = 'Compte';
    
    /**
     * Créé un nouveau contrôleur de la page d'e mon compte.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('MonCompte');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        if (self::isMemberConnect()) {
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
        if (self::isMemberConnect()) {
            if ($nom == "Langue") {
                $this->langues = Langue::getLangues();
            } else if ($nom == "Avatar") {
                $this->avatars = Avatar::getAvatars();
            }
            
            require VUES . 'MonCompte/SousMenu/' . $nom . '.php';
        } else {
            header('Location: /');
        }
    }

    /**
     * Méthode lancée pour modifier son email et/ou mot de passe
     */
    public function modifier()
    {
        if (self::isMemberConnect()) {
            $this->modifOK = false;
            
            if (isset($_POST['email']) && isset($_POST['mdp'])) {
                
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
            }
            
            $_SESSION['menu'] = "Compte";
            
            $this->index();
        } else {
            header('Location: /');
        }
    }

    /**
     * Méthode lancée pour modifier son avatar
     */
    public function modifierAvatar()
    {
        if (self::isMemberConnect()) {
            $this->modifOK = false;
            
            if (isset($_POST['nomAvatar'])) {
                $nomAvatar = $_POST['nomAvatar'];
                
                $this->modifOK = $_SESSION['util']->modifierAvatar($nomAvatar);
            }
            
            $_SESSION['menu'] = "Avatar";
            
            $this->index();
        } else {
            header('Location: /');
        }
    }

    /**
     * Méthode lancée pour modifier sa langue
     */
    public function modifierLangue()
    {
        if (self::isMemberConnect()) {
            $this->modifOK = false;
            
            if (isset($_POST['nomLangue'])) {
                $maLangue = $_POST['nomLangue'];
                
                $this->modifOK = $_SESSION['util']->modifierLangue($maLangue);
            }
            
            $_SESSION['menu'] = "Langue";
            
            $this->index();
        } else {
            header('Location: /');
        }
    }
}