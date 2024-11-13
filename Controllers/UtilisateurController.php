<?php

require_once("./Models/UtilisateurModel.php");
require_once("./Controllers/MainController.php");

class UtilisateurController extends MainController{
    private $UtilisateurModel;

    public function __construct(){
        $this->UtilisateurModel = new UtilisateurModel();
    }

    public function logement(){
        $data_page = [
            "page_description" => "Description de la page de recherche de logement",
            "page_title" => "Titre de la page de recherche de logement",
            "view" => "Views/Logement.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

}