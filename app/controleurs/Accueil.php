<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use DOMDocument;

/**
 * Contrôleur de la page d'accueil du site.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Accueil extends Controleur
{    
    private static $ID_DEFAUT = "FR";
    
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
        $this->setTitre('Accueil');        
        
        $idSangueUtil = self::$ID_DEFAUT;
        
        if ($_SESSION != null && $_SESSION['util'] != null) {
            $langueUtil = $_SESSION['util']->getLangue();
            
            if ($langueUtil != null) {
                $idSangueUtil = $langueUtil->getId();
            }
        }
        
        $doc = new DOMDocument;
        $doc->load(XML_SLIDER);
        
        $photos = $doc->getElementsByTagName('photo');
                
        require_once VUES . 'VueAccueil.php';
    }
}