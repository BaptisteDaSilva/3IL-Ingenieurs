<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

use Rodez_3IL_Ingenieurs\Modeles;
require_once MODELES . 'Message.php';

/**
 * Contrôleur de la page d'accueil du site.
 * 
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Accueil extends Controleur
{    
    private $lesMess;

    /**
     * Créé un nouveau contrôleur de la page d'accueil.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre('Accueil');
        
        $this->lesMess = Modeles\Message::getMessages();
        
        require_once VUES . 'VueAccueil.php';
    }
}