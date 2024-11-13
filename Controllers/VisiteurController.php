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

    public function echange(): void{
        $data_page = [
            "page_description" => "Page d'échange",
            "page_title" => "échanges",
            "view" => "Views/Echange.view.php",
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


    public function valider_connexion($email, $password){
        $role=$this->VisiteurModel->connexionValide($email, $password);
        if ($role!=null) {
            $_SESSION['profil'] = [
                "email" => $email,
                "role" =>$role
            ];
           header("Location: " . URL . "accueil");
        } else {
            header("Location: " . URL . "connexion");
        }
    }

    public function deconnexion(){
        unset($_SESSION['profil']);
        header("Location: " . URL . "accueil");
    }

    public function valider_inscription($nom,$prenom,$email,$telephone,$info,$password){
        $_SESSION['profil'] = [
            "email" => $email,
            "role" =>"Utilisateurs",
        ];
        $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
        $this->VisiteurModel->inscription($nom,$prenom,$email,$telephone,$info,$passwordCrypte);
        header("Location: ". URL . "accueil");
    }

}