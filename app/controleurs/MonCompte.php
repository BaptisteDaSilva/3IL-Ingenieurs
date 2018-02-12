<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;
use Rodez_3IL_Ingenieurs\Modeles\Avatar;
use Rodez_3IL_Ingenieurs\Libs\Photo;

/**
 * Contrôleur des pages de gestion de son compte du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class MonCompte extends Controleur
{

    /** @var bool */
    private $modifOK;

    /** @var resource TODO ecrire */
    public $langues;

    /** @var resource TODO ecrire */
    public $avatars;

    /** @var resource TODO ecrire */
    public $utilisateurs;

    /** @var resource TODO ecrire */
    public $administrateurs;

    /** @var resource TODO ecrire */
    public $photos;

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

    /**
     * TODO ecrire
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
            
            $this->setTitre($this->modifOK ? "Modification Réussie !" : "Un Problème est survenue");
            
            require_once VUES . 'MonCompte/VueCompteModifie.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * TODO ecrire
     */
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

    /**
     * TODO ecrire
     */
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

    /**
     * TODO ecrire
     *
     * @param string $nom
     *            TODO ecrire
     */
    public function SousMenu($nom)
    {
        if ($nom == "Langue" || $nom == "AdminLangue") {
            $this->langues = Langue::getLangues();
        } else if ($nom == "Avatar" || $nom == "AdminAvatar") {
            $this->avatars = Avatar::getAvatars();
        } else if ($nom == "AdminMembre") {
            $this->administrateurs = Utilisateur::getAdministateurs();
            $this->utilisateurs = Utilisateur::getUtilisateurs();
        } else if ($nom == "AdminPhoto") {
            $this->photos = Photo::getPhotos();
        } else if ($nom == "AdminDescriptionPhoto") {
            $this->photos = Photo::getPhotos();
            $this->langues = Langue::getLangues();
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