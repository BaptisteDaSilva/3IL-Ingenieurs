<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

/**
 * Classe représentant un message.
 *
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Message extends Modele
{    
    /**
     * Requête SQL permettant de récupérer les détails d'une ville.
     */
    const RQT_ALL_MESSAGE = 'SELECT idMessage, leMessage
                                   FROM Message';
    
    /** @var string TODO ecrire */
    private $idMessage;
    
    /** @var string TODO ecrire */
    private $leMessage;
    
    /** @var Message[] TODO ecrire */
    private $messages;
    
    /**
     * TODO ecrire
     *
     * @param string $idMessage TODO ecrire
     * @param String $leMessage TODO ecrire
     */
    public function __construct($idMessage, $leMessage)
    {
        $this->idMessage = $idMessage;
        $this->leMessage = $leMessage;
    }
    
    /**
     * TODO ecrire
     *
     * @param $numInsee string TODO ecrire
     * @return Message|null TODO ecrire
     */
    public static function getMessages()
    {        
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_ALL_MESSAGE);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde la ligne retournée.
        $messBD = $requete->fetchAll();
        
        // Créé la liste des départements.
        for ($i = 0; $i < count($messBD); $i ++) {
            $messages[$i] = new Message($messBD[$i]->idMessage, $messBD[$i]->leMessage);
        }
        
        // Retourne la listes des départements.
        return isset($messages) ? $messages : null;
    }
    
    /**
     * @return string le message
     */
    public function getIdMessage()
    {
        return $this->idMessage;
    }
    
    /**
     * @return string le message
     */
    public function getLeMessage()
    {
        return $this->leMessage;
    }
}