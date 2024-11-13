<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
require_once("controllers/VisiteurController.php");
require_once("controllers/AdministrateurController.php");

$visiteurController = new VisiteurController();
$administrateurController = new AdministrateurController();

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {
        case "accueil":
            $visiteurController->accueil();
            break;

        case "inscription":
            $visiteurController->inscription();
            break;

        case "connexion":
            $visiteurController->connexion();
            break;

        case "validation_connexion":
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            $visiteurController->valider_connexion($email, $password);
            break;
        
        case "inscription":
            $visiteurController->inscription();
            break;
        
        case "validation_inscription":
            $nom=htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
            $prenom=htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
            $email=htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $telephone=htmlspecialchars($_POST['telephone'], ENT_QUOTES, 'UTF-8');
            if(!empty($_POST['infos'])){
                $info=htmlspecialchars($_POST['infos'], ENT_QUOTES, 'UTF-8');
            }else{
                $info=null;
            }
            $password=htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            $visiteurController->valider_inscription($nom,$prenom,$email,$telephone,$info,$password);
            break;

        case "deconnexion":
            $visiteurController->deconnexion();
            break;
        
        case "droits":
            if(!empty($_SESSION['profil']) && $_SESSION['profil']['role']==="Admin"){
                $administrateurController->droits();
            }
            break;
        case "supprimer_utilisateur":
            if(!empty($_SESSION['profil']) && $_SESSION['profil']['role']==="Admin"){
                $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTD-8');
                $administrateurController->supprimer_utilisateur($email);
            }
            break;
        
        case "modifier_role":
            if(!empty($_SESSION['profil']) && $_SESSION['profil']['role']==="Admin"){
                $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTD-8');
                $administrateurController->supprimer_utilisateur($email);
            }
            break;

        case "deconnexion":
            $visiteurController->deconnexion();
            break;

        
    }
} catch (Exception $e) {
    echo ("La page n'existe pas");
}
