<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Libs\Photo;

/**
 * Contrôleur de la page d'accueil du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Accueil extends Controleur
{

    /** @var resource Photos afichiés dans le slider */
    private static $photos;

    /**
     * Créé un nouveau contrôleur de la page d'accueil.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Accueil');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre($this->get('Accueil', 'Titre'));
        
        $idLangueUtil = DEFAUT_ID_LANGUE;
        
        if ($_SESSION != null && $_SESSION['util'] != null) {
            $langueUtil = $_SESSION['util']->getLangue();
            
            if ($langueUtil != null) {
                $idLangueUtil = $langueUtil->getId();
            }
        }
        
        self::$photos = Photo::getNameAndDescriptionPhotos($idLangueUtil);
        
        require_once VUES . 'Accueil/VueAccueil.php';
    }
}