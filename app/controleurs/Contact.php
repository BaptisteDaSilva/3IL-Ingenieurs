<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page de contact.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Contact extends Controleur
{
    /**
     * Créé un nouveau contrôleur de la page de contact.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Contact');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre($this->get('Contact', 'Titre'));
        
        require_once VUES . 'Contact/VueContact.php';
    }
    
    public function sendMail() {
        $to      = 'baptiste-da-silva@hotmail.fr';
        $subject = 'le sujet';
        $message = 'Bonjour !';
        $headers = 'From: 3iL_Ingénieurs <test@3il.com>' . "\r\n";
        
        ini_set($varname, $newvalue);
        
        mail ($to, $subject , $message ,$headers );
    }
}