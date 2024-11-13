<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
require_once("Controllers/VisiteurController.php");
require_once("Controllers/AdministrateurController.php");
require_once("Controllers/UtilisateurController.php");

$visiteurController = new VisiteurController();
$administrateurController = new AdministrateurController();
$utilisateurController = new UtilisateurController();

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {
        case "echange":
            $utilisateurController->echange();
            break;
        case "creer_echange":
            $item_offert = htmlspecialchars($_POST['item_offert'],ENT_QUOTES,'UTF-8');
            $description = htmlspecialchars($_POST['description'],ENT_QUOTES,'UTF-8');
            $utilisateurController->creer_echange($item_offert, $description);
            break;
        case "repondre_echange":
            $reponse = htmlspecialchars($_POST['message'],ENT_QUOTES,'UTF-8');
            $id_offre = $_POST['offre'];
            $utilisateurController->repondre_echange($id_offre, $reponse);
            break;
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
                $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
                $administrateurController->supprimer_utilisateur($email);
            }
            break;
        
        case "modifier_role":
            if(!empty($_SESSION['profil']) && $_SESSION['profil']['role']==="Admin"){
                $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
                $role=htmlspecialchars($_POST['role'],ENT_QUOTES,'UTF-8');
                $administrateurController->validation_modificationRole($email,$role);
            }
            break;
        
        case "profil":
            if(!empty($_SESSION['profil'])){
                $visiteurController->profil();
            }
            break;
        
        case "modifier_info":
            $info=htmlspecialchars($_POST['infos'],ENT_QUOTES,'UTF-8');
            $email=htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8');
            $visiteurController->modifierInfo($email,$info);
            break;
        
        case "logement":
            if(!empty($_SESSION['profil'])){
                $utilisateurController->logement();
            }
            break;
        
        case "ajouter_annonce":
            if(!empty($_SESSION['profil'])){
                $titre = $_POST['titre'];
                $type_logement = $_POST['type_logement'];
                $prix = $_POST['prix'];
                $description = $_POST['description'];
                $ville = $_POST['ville'];
                $adresse=htmlspecialchars($_POST['adresse'],ENT_QUOTES,'UTF-8');
                $proximite=htmlspecialchars($_POST['proximite'],ENT_QUOTES,'UTF-8');
                $surface=$_POST['surface'];
                $utilisateurController->ajouter_annonce($titre,$type_logement,$prix,$description,$ville,$adresse,$proximite,$surface);
            }
            break;

        case "deconnexion":
            $visiteurController->deconnexion();
            break;
  
    }
} catch (Exception $e) {
    echo ("La page n'existe pas");
}
