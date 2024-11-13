<?php

require_once("./Models/UtilisateurModel.php");
require_once("./Controllers/MainController.php");

class UtilisateurController extends MainController{
    private $UtilisateurModel;

    public function __construct(){
        $this->UtilisateurModel = new UtilisateurModel();
    }

    public function logement($type_logement,$prix_max,$ville){
        $annonces=$this->UtilisateurModel->getAnnonces($type_logement,$prix_max,$ville);
        $data_page = [
            "page_description" => "Description de la page de recherche de logement",
            "page_title" => "Titre de la page de recherche de logement",
            "annonces" => $annonces,
            "view" => "Views/Logement.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function echange(): void{
        $offresEchange = $this->UtilisateurModel->getAnnoncesEchanges();
        $data_page = [
            "page_description" => "Page d'échange",
            "offres" => $offresEchange,
            "page_title" => "échanges",
            "view" => "Views/Echange.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function creer_echange($item_offert, $description): void{
        $this->UtilisateurModel->creer_echange($item_offert, $description, date("Y-m-d H:i:s"));
        header("Location: " . URL . "echange");
    }

    public function repondre_echange($id_offre, $reponse){
        $this->UtilisateurModel->creer_reponse($id_offre, $reponse, date("Y-m-d H:i:s"));
        header("Location: " . URL . "echange");
    }

    public function ajouter_annonce($titre,$type_logement,$prix,$description,$ville,$adresse,$proximite,$surface,$images){
        $this->UtilisateurModel->ajouterAnnonce($titre,$type_logement,$prix,$description,$ville,$adresse,$proximite,$surface);
        header("Location: " . URL . "logement");
    }

    public function plus_infos_logement($id){
        $annonce=$this->UtilisateurModel->infoAnnonce($id);
        $data_page = [
            "page_description" => "Description de la page de recherche de logement",
            "page_title" => "Titre de la page de recherche de logement",
            "annonce"=>$annonce,
            "view" => "Views/DetailAnnonce.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function aide(){
        $data_page = [
            "page_description" => "Description de la page de recherche de logement",
            "page_title" => "Titre de la page de recherche de logement",
            "view" => "Views/Aides.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function evenement(){
        $data_page = [
            "page_description" => "Description de la page de recherche de logement",
            "page_title" => "Titre de la page de recherche de logement",
            "view" => "Views/Evenement.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

}