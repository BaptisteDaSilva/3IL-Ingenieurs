<?php
namespace Rodez_3IL_Ingenieurs\Libs;

use Rodez_3IL_Ingenieurs\Modeles\Langue;

/**
 * Classe des fonctions du slider
 *
 * @package Rodez_3IL_Ingenieurs\Libs
 */
class PhotoSlider
{

    /**
     * Chemin vers le fichier XML qui contient les photos du slider
     */
    private static $XML_SLIDER_SAVE = '../app/vues/Accueil/slider.xml';

    /**
     * Document XML qui contient les informations pour le slider
     */
    private static $docXML;

    /**
     * Charge le document XML qui contient les informations pour le slider
     *
     * @return \DOMDocument Document XML
     */
    private static function getDoc()
    {
        if (self::$docXML == null) {
            self::$docXML = new \DOMDocument();
            self::$docXML->load(XML_SLIDER);
        }
        
        return self::$docXML;
    }

    /**
     * Sauvegarde le document XML qui contient les informations pour le slider
     *
     * @return boolean True si sauvegarde OK, false sinon
     */
    private static function save()
    {
        return self::getDoc()->save(self::$XML_SLIDER_SAVE);
    }

    /**
     * Retourne l'élement qui contient toute les informations pour le slider
     *
     * @return \DOMElement Balise slider
     */
    private static function getSlider()
    {
        return self::getDoc()->getElementsByTagName('slider')[0];
    }

    /**
     * Retourne la balise d'une photo demandée
     *
     * @param string $name
     *            Nom de la photo
     * @return \DOMElement Element photo
     */
    private static function getPhotoE($name)
    {
        foreach (self::getPhotos() as $ePhoto) {
            if (self::getName($ePhoto) == $name) {
                return $ePhoto;
            }
        }
    }

    /**
     * Retourne la liste des photos
     *
     * @return \DOMNodeList Balises photo
     */
    private static function getPhotos()
    {
        return self::getDoc()->getElementsByTagName('photo');
    }

    /**
     * Retourne la liste des noms des photos
     *
     * @return array Noms des photos
     */
    public static function getNamePhotos()
    {
        $names = array();
        
        foreach (self::getPhotos() as $photo) {
            $names[] = self::getName($photo);
        }
        
        return $names;
    }

    /**
     * Retourne la liste des noms des photos
     *
     * @return array Noms des photos
     */
    public static function getNameAndDescriptionPhotos($idLangue)
    {
        $names = array();
        
        foreach (self::getPhotos() as $photo) {
            $name = self::getName($photo);
            
            $names[] = array(
                "name" => $name,
                "desc" => self::getDescription($name, $idLangue)
            );
        }
        
        return $names;
    }

    /**
     * Retourne le nom d'une photo
     *
     * @param \DOMElement $photo
     *            Photo dont on shouhaite le nom
     * @return string Le nom de la photo
     */
    public static function getName($photo)
    {
        return $photo->getAttribute('name');
    }

    /**
     * Retourne la balise description d'une photo dans une langue donnée
     *
     * @param string $name
     *            Nom de la photo
     * @param string $idSangue
     *            Identifiant de la langue
     * @return \DOMElement Element description
     */
    public static function getDescriptionE($name, $idSangue)
    {
        return self::getDoc()->getElementById($idSangue . '_' . $name);
    }

    /**
     * Retourne la description d'une photo
     *
     * @param string $name
     *            Nom de la photo dont on shouaite la description
     * @param string $idSangue
     *            Langue dans laquelle on souhaite la description
     * @return string La decription de la photo
     */
    public static function getDescription($name, $idSangue)
    {
        return self::getDescriptionE($name, $idSangue)->nodeValue;
    }

    /**
     * Ajoute une description a toute les photos pour une langue
     *
     * @param string $idSangue
     *            Identifiant pour une langue
     */
    public static function addDescriptions($idSangue)
    {
        $doc = self::getDoc();
        
        foreach (self::getPhotos() as $ePhoto) {
            $eDesc = $doc->createElement('description');
            $eDesc->setAttribute('id', $idSangue . '_' . self::getName($ePhoto));
            
            $ePhoto->appendChild($eDesc);
        }
        
        return self::save();
    }

    /**
     * Supprime les descriptions pour une langue
     *
     * @param string $idSangue
     *            Identifiant de la langue
     * @return boolean True si sauvegarde OK, false sinon
     */
    public static function deleteDescription($idSangue)
    {
        foreach (self::getPhotos() as $photo) {
            $name = self::getName($photo);
            
            $descriptionE = self::getDescriptionE($name, $idSangue);
            
            self::getPhotoE($name)->removeChild($descriptionE);
        }
        
        return self::save();
    }

    /**
     * Met a jour une description
     *
     * @param string $name
     *            Nom de la photo
     * @param string $idSangue
     *            Identifiant de la langue
     * @param string $value
     *            Nouvelle description
     * @return boolean True si sauvegarde OK, false sinon
     */
    public static function updateDescription($name, $idSangue, $newDescrition)
    {
        self::getDescriptionE($name, $idSangue)->nodeValue = $newDescrition;
        
        return self::save();
    }

    /**
     * Ajoute une photo au slider
     *
     * @param string $name
     *            Nom de la photo
     * @return boolean True si sauvegarde OK, false sinon
     */
    public static function add($name)
    {
        $doc = self::getDoc();
        
        $ePhoto = $doc->createElement('photo');
        $attName = $doc->createAttribute('name');
        $attName->value = $name;
        $ePhoto->appendChild($attName);
        
        foreach (Langue::getLangues() as $langue) {
            $eDesc = $doc->createElement('description');
            $eDesc->setAttribute('id', $langue->getId() . '_' . $name);
            $ePhoto->appendChild($eDesc);
        }
        
        self::getSlider()->appendChild($ePhoto);
        
        return self::save();
    }

    /**
     * Supprime une photo du slider
     *
     * @param string $name
     *            Nom de la photo
     * @return boolean True si sauvegarde OK, false sinon
     */
    public static function delete($name)
    {
        foreach (self::getPhotos() as $photo) {
            if (self::getName($photo) == $name) {
                self::getSlider()->removeChild($photo);
            }
        }
        
        return self::save();
    }
}