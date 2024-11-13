<?php
require_once("./Models/AdministrateurModel.php");
require_once("./Controllers/MainController.php");

class AdministrateurController extends MainController
{
    private $AdministrateurModel;
    public function __construct()
    {
        $this->AdministrateurModel = new AdministrateurModel();
    }

    public function droits()
    {
        $utilisateurs = $this->AdministrateurModel->getUtilisateurs();
        $data_page = [
            "page_description" => "Gestion des droits",
            "page_title" => "Gestion des droits",
            "utilisateurs" => $utilisateurs,
            "view" => "Views/Droits.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validation_modificationRole($role, $email)
    {
        $this->AdministrateurModel->modifierRole($email, $role);
        header("Location: " . URL . "droits");
    }

    public function supprimer_utilisateur($role, $email)
    {
        $this->AdministrateurModel->supprimer_utilisateur($role, $email);
        $utilisateurs = $this->AdministrateurModel->getUtilisateurs();
        $data_page = [
            "page_description" => "Gestion des droits",
            "page_title" => "Gestion des droits",
            "utilisateurs" => $utilisateurs,
            "view" => "Views/Droits.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function themes()
    {
        $themes = $this->AdministrateurModel->getThemes();
        $profs = $this->AdministrateurModel->getProfs();
        $data_page = [
            "page_description" => "Gestion des droits",
            "page_title" => "Gestion des droits",
            "themes" => $themes,
            "profs" => $profs,
            "view" => "Views/Themes.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function ajouter_theme($intitule, $description, $nouvelles_matieres)
    {
        $nouveauxDetails = [
            'intitule' => $intitule,
            'description' => $description,
            'Matieres' => $nouvelles_matieres,
        ];
        $this->AdministrateurModel->ajouterTheme($nouveauxDetails);
        header("Location: " . URL . "themes");
    }

    public function validation_modifier_theme($themeIntitule, $matieres, $intitule, $description, $nouvelles_matieres, $matieres_suppr)
    {
        $nouveauxDetails = [
            'intitule' => $intitule,
            'description' => $description,
            'matieres' => $matieres,
            'nouvelles_matieres' => $nouvelles_matieres,
            'matieres_a_supprimer' => $matieres_suppr
        ];
        $this->AdministrateurModel->modifierTheme($themeIntitule, $nouveauxDetails);
        header("Location: " . URL . "themes");
    }

    public function supprimer_theme($intitule)
    {
        $this->AdministrateurModel->supprimer_theme($intitule);
        header("Location: " . URL . "themes");
    }
}
