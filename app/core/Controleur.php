<?php
namespace Rodez_3IL_Ingenieurs\Core;

use Rodez_3IL_Ingenieurs\Libs\Properties;
use Rodez_3IL_Ingenieurs\Modeles\Utilisateur;

/**
 * Classe du contrôleur par défaut, tous les contrôleurs doivent hériter
 * de cette classe.
 *
 * @package Rodez_3IL_Ingenieurs\Core
 */
abstract class Controleur
{

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
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public abstract function index();

    /**
     *
     * @return string le titre de la page.
     */
    public function getTitre()
    {
        return self::get('Titre') . ' - ' . $this->titre;
    }

    /**
     * Modifie le titre de la page.
     *
     * @param $titre string
     *            le titre de la page.
     */
    protected function setTitre($titre)
    {
        $this->titre .= $titre;
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

    /**
     * Fonction permettant de savoir si un adminstrateur est connecté
     */
    public static function isMemberConnect()
    {
        return isset($_SESSION['util']) && $_SESSION['util'] instanceof Utilisateur;
    }

    /**
     * Fonction permettant de savoir si un adminstrateur est connecté
     */
    public static function isAdminConnect()
    {
        return self::isMemberConnect() && $_SESSION['util']->isAdmin();
    }

    /**
     * Fonction permettant de savoir si un adminstrateur est connecté
     */
    public static function get()
    {
        return Properties::get(func_get_args());
    }
}