<?php
namespace Rodez_3IL_Ingenieurs\Core;

/**
 * Classe du contrôleur par défaut, tous les contrôleurs doivent hériter
 * de cette classe.
 * 
 * @package Rodez_3IL_Ingenieurs\Core
 */
abstract class Controleur
{    
    /** @var string le titre du site. */
    private static $TITRE_SITE = '3IL-Ingénieurs';

    /** @var string le titre de la page. */
    private $titre;

    /** @var string l'onglet actif dans le menu. */
    private $active;

    /**
     * Créé un nouveau contrôleur.
     */
    public function __construct()
    {
        session_start();
        $this->titre = self::$TITRE_SITE;
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public abstract function index();
    
    /**
     *
     * @return string le titre du site.
     */
    public static function getTitreSite()
    {
        return self::$TITRE_SITE;
    }

    /**
     *
     * @return string le titre de la page.
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Modifie le titre de la page.
     * 
     * @param $titre string
     *            le titre de la page.
     */
    protected function setTitre($titre)
    {
        $this->titre .= ' - ' . $titre;
    }
    
    /**
     *
     * @return string le titre de la page.
     */
    public function getActivePage()
    {
        return $this->active;
    }

    /**
     * Modifie la page active dans le menu.
     * 
     * @param $activePage string
     *            la page active.
     */
    protected function setActivePage($activePage)
    {
        $this->active = $activePage;
    }
}