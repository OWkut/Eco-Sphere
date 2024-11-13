<?php

require_once("./Models/VisiteurModel.php");
require_once("./Controllers/MainController.php");

class VisiteurController extends MainController{
    private $VisiteurModel;
    public function __construct(){
        $this->VisiteurModel = new VisiteurModel();
    }
    public function accueil(){
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "Views/Accueil.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function inscription(){
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "Views/Inscription.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function connexion(){
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "Views/Connexion.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function valider_inscription($email, $password) {
        $this->VisiteurModel->creer_compte($email, $password);
        $_SESSION['profil'] = [
            "email" => $email,
            "role" => "Eleves"
        ];
        header("Location: " . URL . "accueil");
    }

    public function valider_connexion($email, $password){
        if ($this->VisiteurModel->connexion($email, $password)) {
           header("Location: " . URL . "accueil");
        } else {
            header("Location: " . URL . "connexion");
        }
    }

    public function deconnexion(){
        unset($_SESSION['profil']);
        header("Location: " . URL . "accueil");
    }

}