<?php

require_once "./Models/VisiteurModel.php";
require_once "./Controllers/MainController.php";

class VisiteurController extends MainController{
    private $VisiteurModel;
    private $template;

    public function __construct(){
        $this->VisiteurModel = new VisiteurModel();
        $this->template = "Views/common/template.php";
    }

    public function accueil(){
        $data_page = [
            "page_description" => "page d'accueil de éco-sphere",
            "page_title" => "Eco-Sphere",
            "view" => "Views/Accueil.view.php",
            "template" => $this->template
        ];
        $this->genererPage($data_page);
    }

   

    public function inscription(){
        $data_page = [
            "page_description" => "page d'accueil de éco-sphere",
            "page_title" => "Eco-Sphere",
            "view" => "Views/Inscription.view.php",
            "template" => $this->template
        ];
        $this->genererPage($data_page);
    }

    public function connexion(){
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "Views/Connexion.view.php",
            "template" => $this->template
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

    public function profil(){
        $data=$this->VisiteurModel->getInfoPerso();
        $data_page = [
            "page_description" => "Description du profil",
            "page_title" => "Profil",
            "user" => $data,
            "view" => "Views/Profil.view.php",
            "template" => "Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function modifierInfo($email,$info){
        $this->VisiteurModel->modifierInfo($email,$info);
        header("Location: " . URL . "profil");
    }

}