<?php
namespace Rodez_3IL_Ingenieurs\Libs;

/**
 * Classe représentant la connexion à la base de données.
 *
 * @package Rodez_3IL_Ingenieurs\Libs
 */
class Photo
{

    /**
     * TODO ecrire
     */
    private static $XML_SLIDER_SAVE = '../app/vues/Accueil/slider.xml';

    /**
     * TODO ecrire
     */
    private static $doc;

    /**
     * TODO ecrire
     *
     * @return \DOMDocument TODO ecrire
     */
    private static function getDoc()
    {
        if (self::$doc == null) {
            self::$doc = new \DOMDocument();
            self::$doc->load(XML_SLIDER);
        }
        
        return self::$doc;
    }

    /**
     * TODO ecrire
     */
    private static function save()
    {
        self::getDoc()->save(self::$XML_SLIDER_SAVE);
    }

    /**
     * TODO ecrire
     *
     * @return \DOMNodeList TODO ecrire
     */
    private static function getSlider()
    {
        return self::getDoc()->getElementsByTagName('slider')[0];
    }

    /**
     * TODO ecrire
     *
     * @param string $name
     *            TODO ecrire
     * @return \DOMNodeList TODO ecrire
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
     * TODO ecrire
     *
     * @return \DOMNodeList TODO ecrire
     */
    public static function getPhotos()
    {
        return self::getDoc()->getElementsByTagName('photo');
    }

    /**
     * TODO ecrire
     *
     * @param \DOMElement $photo
     *            TODO ecrire
     * @return string TODO ecrire
     */
    public static function getName($photo)
    {
        return $photo->getAttribute('name');
    }

    /**
     * TODO ecrire
     *
     * @param string $name
     *            TODO ecrire
     * @param string $idSangue
     *            TODO ecrire
     * @return \DOMElement TODO ecrire
     */
    public static function getDescriptionE($name, $idSangue)
    {
        return self::getDoc()->getElementById($idSangue . '_' . $name);
    }

    /**
     * TODO ecrire
     *
     * @param string $name
     *            TODO ecrire
     * @param string $idSangue
     *            TODO ecrire
     * @return string TODO ecrire
     */
    public static function getDescription($name, $idSangue)
    {
        return self::getDescriptionE($name, $idSangue)->nodeValue;
    }

    /**
     * TODO ecrire
     *
     * @param string $idSangue
     *            TODO ecrire
     * @param boolean $save
     *            TODO ecrire
     */
    public static function addDescription($idSangue, $save = true)
    {
        $doc = self::getDoc();
        
        foreach (self::getPhotos() as $ePhoto) {
            $eDesc = $doc->createElement('description');
            $eDesc->setAttribute('id', $idSangue . '_' . self::getName($ePhoto));
            
            $ePhoto->appendChild($eDesc);
        }
        
        if ($save)
            self::save($doc);
    }

    /**
     * TODO ecrire
     *
     * @param string $idSangue
     *            TODO ecrire
     */
    public static function deleteDescription($idSangue)
    {
        $doc = self::getDoc();
        
        foreach (self::getPhotos() as $photo) {
            $name = self::getName($photo);
            
            var_dump($name . ' - ' . $idSangue);
            
            $descriptionE = self::getDescriptionE($name, $idSangue);
            
            self::getPhotoE($name)->removeChild($descriptionE);
        }
        
        self::save($doc);
    }

    /**
     * TODO ecrire
     * 
     * @param string $name
     *            TODO ecrire
     * @param string $idSangue
     *            TODO ecrire
     * @param string $value
     *            TODO ecrire
     */
    public static function updateDescription($name, $idSangue, $value)
    {
        $doc = self::getDoc();
        
        self::getDescriptionE()->nodeValue = $value;
        
        self::save($doc);
    }

    /**
     * TODO ecrire
     * 
     * @param string $name
     *            TODO ecrire
     */
    public static function addPhoto($name)
    {
        $doc = self::getDoc();
        
        $ePhoto = $doc->createElement('photo');
        $ePhoto->appendChild($doc->createAttribute('name', $name));
        
        addDescription($langue->getId(), false);
        
        self::getSlider()->appendChild($ePhoto);
        
        self::save($doc);
    }

    /**
     * TODO ecrire
     * 
     * @param string $name
     *            TODO ecrire
     */
    public static function deletePhoto($name)
    {
        foreach (self::getPhotos() as $photo) {
            if (self::getName($photo) == $aSupp) {
                self::getSlider()->removeChild($photo);
            }
        }
        
        self::save($doc);
    }
}