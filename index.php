<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
require_once("Controllers/VisiteurController.php");
require_once("Controllers/AdministrateurController.php");

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
        case "echange":
            $visiteurController->echange();
        case "accueil":
            $visiteurController->accueil();
            break;

        case "inscription":
            $visiteurController->inscription();
            break;

        case "connexion":
            $visiteurController->connexion();
            break;

        case "validation_inscription":
            $email = $_POST['email'];
            $password = $_POST['password'];
            $visiteurController->valider_inscription($email, $password);
            break;

        case "validation_connexion":
            $email = $_POST['email'];
            $password = $_POST['password'];
            $visiteurController->valider_connexion($email, $password);
            break;

        case "deconnexion":
            $visiteurController->deconnexion();
            break;

        case "droits":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $administrateurController->droits();
            }
            break;

        case "supprimer_utilisateur":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $role = $_POST['role'];
                $email = $_POST['email'];
                $administrateurController->supprimer_utilisateur($role, $email);
            }
            break;
    }
} catch (Exception $e) {
    echo ("La page n'existe pas");
}
