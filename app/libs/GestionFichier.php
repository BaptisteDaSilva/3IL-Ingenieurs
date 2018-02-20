<?php
namespace Rodez_3IL_Ingenieurs\Libs;

/**
 * Classe des fonctions de gestion des fichiers
 *
 * @package Rodez_3IL_Ingenieurs\Libs
 */
class GestionFichier
{

    /** @var string Fichier de type image d'avatar */
    public static $TYPE_AVATAR = '../public/img/avatar/';

    /** @var string Fichier de type drapeau */
    public static $TYPE_DRAPEAU = '../public/img/drapeau/';

    /** @var string Fichier de type properties */
    public static $TYPE_PROPERTIES = '../public/properties/';

    /**
     * Télécharge un fichier sur le serveur
     *
     * @param string $type
     *            Type de fichier
     * @param string $oldName
     *            Ancien nom du fichier
     * @param string $newName
     *            Nouveau nom du fichier
     */
    public static function telecharger($type, $oldName, $newName)
    {
        move_uploaded_file($oldName, $type . $newName);
    }

    /**
     * Supprime un fichier du serveur
     *
     * @param string $type
     *            Type de fichier
     * @param string $name
     *            Nom du fichier
     */
    public static function supprimer($type, $name)
    {
        unlink($type . $name);
    }
}