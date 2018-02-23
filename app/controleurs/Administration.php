<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Avatar;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;
use Rodez_3IL_Ingenieurs\Libs\Photo;
use Rodez_3IL_Ingenieurs\Libs\Properties;

/**
 * Contrôleur de la page des pages d'administration du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Administration extends Controleur
{

    /** @var bool */
    private $modifOK;

    /** @var resource Listes des avatars du site */
    public $avatars;

    /** @var resource Liste des utilisateurs du site */
    public $utilisateurs;

    /** @var resource Liste des administrateurs du site */
    public $administrateurs;

    /** @var resource Liste des noms des photos du site */
    public $photos;

    /** @var resource Liste des noms et descriptions des photos du site */
    public $descriptions;

    /** @var string Menu a affiché dans mon compte */
    public $MENU_DEFAUT = 'Avatar';
    
    /**
     * Créé un nouveau contrôleur de la page d'accueil.
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
        if (self::isAdminConnect()) {
            $this->setTitre($this->get('Administration', 'Titre'));
            
            require_once VUES . 'Administration/VueAdministration.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour afficher un des sous-menu de l'administration
     *
     * @param string $nom
     *            Nom du menu a affiché
     */
    public function SousMenu($nom)
    {
        if (self::isAdminConnect()) {
            switch ($nom) {
                case "Langue":
                    $this->langues = Langue::getLangues();
                    break;
                case "Avatar":
                    $this->avatars = Avatar::getAvatars();
                    break;
                case "Membre":
                    $this->administrateurs = Utilisateur::getAdministateurs();
                    $this->utilisateurs = Utilisateur::getUtilisateurs();
                    break;
                case "Photo":
                    $this->photos = Photo::getNamePhotos();
                    break;
                case "DescriptionPhoto":
                    foreach (Langue::getLangues() as $langue) {
                        $this->descriptions[] = array(
                            "langue" => $langue,
                            "photos" => Photo::getNameAndDescriptionPhotos($langue->getId())
                        );
                    }
                    break;
            }
            
            require VUES . 'Administration/SousMenu/' . $nom . '.php';
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour créer ajouter un avatar
     */
    public function ajouterAvatar()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = false;
            
            if (isset($_FILES['avatar'])) {
                $avatar = new Avatar(null, $_FILES['avatar']['name']);
                
                $this->modifOK = $avatar->ajouter($_FILES['avatar']['tmp_name']);
            }
            
            $_SESSION['menuAdmin'] = 'Avatar';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour supprimer un avatar
     */
    public function supprimerAvatar()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['aSupp'])) {
                foreach ($_POST['aSupp'] as $aSupp) {
                    $avatar = Avatar::getAvatar($aSupp);
                    
                    if ($avatar == null || ! $avatar->supprimer()) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'Avatar';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour ajouter une langue
     */
    public function ajouterLangue()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = false;
            
            if (isset($_POST['id']) && isset($_POST['nom']) && isset($_FILES['drapeau'])) {
                $langue = new Langue($_POST['id'], $_POST['nom']);
                
                $this->modifOK = $langue->ajouter($_FILES['drapeau']['tmp_name'], $_FILES['propertie']['tmp_name']);
            }
            
            $_SESSION['menuAdmin'] = 'Langue';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour supprimer une langue
     */
    public function supprimerLangue()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['aSupp'])) {
                foreach ($_POST['aSupp'] as $aSupp) {
                    $langue = Langue::getLangue($aSupp);
                    
                    if ($langue == null || ! $langue->supprimer()) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'Langue';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour upgrader un membre en administrateur du site
     */
    public function ajouterSuperAdmin()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['aUp'])) {
                foreach ($_POST['aUp'] as $aUp) {
                    $util = Utilisateur::getUtilisateur($aUp);
                    
                    if ($util == null || ! $util->modifierType('A')) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'Membre';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour retorgrader un administrateur à membre
     */
    public function supprimerMembre()
    {
        if (self::isSuperAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['aSupp'])) {
                foreach ($_POST['aSupp'] as $aSupp) {
                    $util = Utilisateur::getUtilisateur($aSupp);
                    
                    if ($util == null || ! $util->deleteBD()) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'Membre';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour supprimer un administrateur
     */
    public function supprimerSuperAdmin()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['aDown'])) {
                foreach ($_POST['aDown'] as $aDown) {
                    $util = Utilisateur::getUtilisateur($aDown);
                    
                    if ($util == null || ! $util->modifierType('U')) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'Membre';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour télécharger le fichier properties par defaut
     */
    public function defaultProperties()
    {
        if (self::isAdminConnect()) {
            $size = filesize(Properties::$PROPERTIES_PATH . Properties::$PROPERTIES_NAME);
            header("Content-Type: application/force-download; name=" . Properties::$PROPERTIES_NAME);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            header("Content-Disposition: attachment; filename=" . Properties::$PROPERTIES_NAME);
            header("Expires: 0");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            readfile(Properties::$PROPERTIES_PATH . Properties::$PROPERTIES_NAME);
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour ajouter des photos au slider
     */
    public function ajouterPhoto()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = false;
            
            if (isset($_FILES['photo'])) {
                $name = str_replace(' ', '', $_FILES['photo']['name']);
                
                $this->modifOK = move_uploaded_file($_FILES['photo']['tmp_name'], '../public/img/photos/' . $name) && Photo::addPhoto($name);
            }
            
            $_SESSION['menuAdmin'] = 'Photo';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour supprimer des photos du slider
     */
    public function supprimerPhoto()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['aSupp'])) {
                
                foreach ($_POST['aSupp'] as $aSupp) {
                    if (! unlink('../public/img/photos/' . $aSupp) || ! Photo::deletePhoto($aSupp)) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'Photo';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour modifier la description des photos du slider
     */
    public function modifierDescriptionPhoto()
    {
        if (self::isAdminConnect()) {
            $this->modifOK = true;
            
            if (isset($_POST['photos']) && isset($_POST['idLangue'])) {
                foreach ($_POST['photos'] as $cle => $value) {
                    if (! Photo::updateDescription($cle, $_POST['idLangue'], $value)) {
                        $this->modifOK = false;
                    }
                }
            }
            
            $_SESSION['menuAdmin'] = 'DescriptionPhoto';
            
            $this->index();
        } else {
            header('Location: /MonCompte/');
        }
    }

    /**
     * Méthode lancée pour modifier la description des photos du slider
     */
    public function modifierTexte()
    {
        if (self::isAdminConnect()) {
            if (isset($_POST['new'])) {
                Properties::set(func_get_args(), $_POST['new']);
            }
            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: /MonCompte/');
        }
    }
}