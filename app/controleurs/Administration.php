<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles\Langue;
use Rodez_3IL_Ingenieurs\Modeles\Avatar;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;
use DOMDocument;

class Administration extends Controleur
{
    private static $properties = '../public/properties/XX.json';
    
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
            $avatar = new Avatar(null, $_FILES['avatar']['name']);
            
            $avatar->ajouter($_FILES['avatar']['tmp_name']);
        }
        
        header('Location: /MonCompte/');
    }

    public function supprimerAvatar()
    {
        if ($_SESSION['util']->isAdmin()) {
            foreach ($_POST['aSupp'] as $aSupp) {
                Avatar::getAvatar($aSupp)->supprimer();
            }
        }
        
        header('Location: /MonCompte/');
    }

    public function ajouterLangue()
    {
        if ($_SESSION['util']->isAdmin()) {
            $langue = new Langue($_POST['id'], $_POST['nom']);
            
            $langue->ajouter($_FILES['drapeau']['tmp_name'], $_FILES['propertie']['tmp_name']);
        }
        
        header('Location: /MonCompte/');
    }

    public function supprimerLangue()
    {
        if ($_SESSION['util']->isAdmin()) {
            foreach ($_POST['aSupp'] as $aSupp) {
                Langue::getLangue($aSupp)->supprimer();
            }
        }
        
        header('Location: /MonCompte/');
    }

    public function ajouterAdmin()
    {
        if ($_SESSION['util']->isAdmin()) {
            var_dump(Utilisateur::getUtilisateur($_POST['aUp'][0]));
            
            foreach ($_POST['aUp'] as $aUp) {
                Utilisateur::getUtilisateur($aUp)->modifierType('A');
            }
        }
        
        header('Location: /MonCompte/');
    }

    public function supprimerAdmin()
    {
        if ($_SESSION['util']->isAdmin()) {
            foreach ($_POST['aDown'] as $aDown) {
                Utilisateur::getUtilisateur($aDown)->modifierType('U');
            }
        }
        
        header('Location: /MonCompte/');
    }

    public function defaultProperties()
    {
        $size = filesize(self::$properties);
        header("Content-Type: application/force-download; name=XX.json");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: $size");
        header("Content-Disposition: attachment; filename=XX.json");
        header("Expires: 0");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        readfile(self::$properties);
    }
    
    public function ajouterPhoto()
    {
        if ($_SESSION['util']->isAdmin()) {
            $name = str_replace(' ', '', $_FILES['photo']['name']);
            
            move_uploaded_file($_FILES['photo']['tmp_name'], '../public/img/photos/' . $name);
                             
            $doc = new DOMDocument;
            $doc->load(XML_SLIDER);
            
            $ePhoto = $doc->createElement('photo');      
            $ePhoto->appendChild($doc->createAttribute('name', $name));
                        
            foreach (Langue::getLangues() as $langue)
            {
                $eDesc = $doc->createElement('description');
                $eDesc->setAttribute('id', $langue->getId() . '_' . $name);
                
                $ePhoto->appendChild($eDesc);
            }           
            
            $doc->getElementsByTagName('slider')[0]->appendChild($ePhoto);
                        
            $doc->save('../public/slider.xml');
        }
        
        header('Location: /MonCompte/');
    }
    
    public function supprimerPhoto()
    {
        if ($_SESSION['util']->isAdmin()) {
            
            $doc = new DOMDocument;
            $doc->load(XML_SLIDER);
            
            foreach ($_POST['aSupp'] as $aSupp) {                
                unlink('../public/img/photos/' . $aSupp);
                                
                foreach ($doc->getElementsByTagName('photo') as $photo)
                {                                        
                    if ($photo->getAttribute('name') == $aSupp){                        
                        $doc->getElementsByTagName('slider')[0]->removeChild($photo);
                    }
                } 
            }
            
            $doc->save('../public/slider.xml');
        }
        
        header('Location: /MonCompte/');
    }
    
    public function modifierDescriptionPhoto()
    {
        if ($_SESSION['util']->isAdmin()) {            
            $doc = new DOMDocument;
            $doc->load(XML_SLIDER);
            
            foreach($_POST['photos'] as $cle=>$value )
            {                
                $doc->getElementById($_POST['idLangue'] . '_' . $cle)->nodeValue = $value;
            }
            
            $doc->save('../public/slider.xml');
        }
    
        header('Location: /MonCompte/');
    }
}