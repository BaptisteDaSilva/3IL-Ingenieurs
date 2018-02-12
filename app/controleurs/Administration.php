<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Avatar;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;
use Rodez_3IL_Ingenieurs\Libs\Photo;

/**
 * Contrôleur de la page des pages d'administration du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Administration extends Controleur
{

    /** @var bool */
    private $modifOK;

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        if (self::isAdminConnect()) {
            header('Location: /MonCompte/');
        } else {
            header('Location: /');
        }
    }

    /**
     * TODO ecrire
     */
    public function ajouterAvatar()
    {
        if (self::isAdminConnect()) {
            $avatar = new Avatar(null, $_FILES['avatar']['name']);
            
            $avatar->ajouter($_FILES['avatar']['tmp_name']);
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function supprimerAvatar()
    {
        if (self::isAdminConnect()) {
            foreach ($_POST['aSupp'] as $aSupp) {
                Avatar::getAvatar($aSupp)->supprimer();
            }
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function ajouterLangue()
    {
        if (self::isAdminConnect()) {
            $langue = new Langue($_POST['id'], $_POST['nom']);
            
            $langue->ajouter($_FILES['drapeau']['tmp_name'], $_FILES['propertie']['tmp_name']);
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function supprimerLangue()
    {
        if (self::isAdminConnect()) {
            foreach ($_POST['aSupp'] as $aSupp) {
                Langue::getLangue($aSupp)->supprimer();
            }
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function ajouterAdmin()
    {
        if (self::isAdminConnect()) {
            foreach ($_POST['aUp'] as $aUp) {
                Utilisateur::getUtilisateur($aUp)->modifierType('A');
            }
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function supprimerAdmin()
    {
        if (self::isAdminConnect()) {
            foreach ($_POST['aDown'] as $aDown) {
                Utilisateur::getUtilisateur($aDown)->modifierType('U');
            }
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function defaultProperties()
    {
        if (self::isAdminConnect()) {
            $size = filesize(DEFAUT_PROPERTIES);
            header("Content-Type: application/force-download; name=XX.json");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            header("Content-Disposition: attachment; filename=XX.json");
            header("Expires: 0");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            readfile(DEFAUT_PROPERTIES);
        } else {
            header('Location: /');
        }
    }

    /**
     * TODO ecrire
     */
    public function ajouterPhoto()
    {
        if (self::isAdminConnect()) {
            $name = str_replace(' ', '', $_FILES['photo']['name']);
            
            move_uploaded_file($_FILES['photo']['tmp_name'], '../public/img/photos/' . $name);
            
            Photo::addPhoto($name);
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function supprimerPhoto()
    {
        if (self::isAdminConnect()) {
            
            foreach ($_POST['aSupp'] as $aSupp) {
                unlink('../public/img/photos/' . $aSupp);
                
                Photo::deletePhoto($aSupp);
            }
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    public function modifierDescriptionPhoto()
    {
        if (self::isAdminConnect()) {
            foreach ($_POST['photos'] as $cle => $value) {
                Photo::updateDescription($cle, $_POST['idLangue'], $value);
            }
        }
        
        header('Location: /MonCompte/');
    }

    /**
     * TODO ecrire
     */
    private static function isAdminConnect()
    {
        return isset($_SESSION['util']) && $_SESSION['util']->isAdmin();
    }
}