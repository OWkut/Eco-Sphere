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
        $this->AdministrateurModel->modifier_role($email, $role);
        header("Location: " . URL . "droits");
    }

    public function supprimer_utilisateur($email)
    {
        $this->AdministrateurModel->supprimer_utilisateur($email);
        header("Location: ". URL . "droits");
    }

    public function supprimer_annonce($id){
        $this->AdministrateurModel->supprimerAnnonce($id);
        header("Location: ". URL . "logement");
    }

}
