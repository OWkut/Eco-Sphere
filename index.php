<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
require_once("controllers/VisiteurController.php");
require_once("controllers/AdministrateurController.php");
require_once("controllers/ProfController.php");
require_once("controllers/EleveController.php");

$visiteurController = new VisiteurController();
$administrateurController = new AdministrateurController();
$profController = new ProfController();
$eleveController = new EleveController();

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

        case "modification_role":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $role = $_POST['role'];
                $email = $_POST['email'];
                $administrateurController->validation_modificationRole($role, $email);
            }
            break;

        case "themes":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $administrateurController->themes();
            }
            break;

        case "ajouter_theme":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $intitule = $_POST['intitule'];
                $description = $_POST['description'];
                $nouvelles_matieres = $_POST['matieres_nouvelles'];
                $administrateurController->ajouter_theme($intitule, $description, $nouvelles_matieres);
            }
            break;

        case "validation_modifier_theme":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $themeIntitule = $_POST['intitule_actuel'];
                $nouveauthemeIntitule = $_POST['nouvel_intitule'];
                $matieres = isset($_POST['matieres']) ? $_POST['matieres'] : null;
                $intitule = $_POST['intitule_actuel'];
                $description = $_POST['description'];
                $nouvelles_matieres = $_POST['matieres_nouvelles_data'];
                $matieres_suppr = $_POST['matieres_a_supprimer'];
                $administrateurController->validation_modifier_theme($themeIntitule, $matieres, $intitule, $description, $nouvelles_matieres, $matieres_suppr);
            }
            break;

        case "supprimer_theme":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Admins') {
                $intitule = $_POST['intitule'];
                $administrateurController->supprimer_theme($intitule);
            }
            break;

        case "cours":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $profController->cours();
            }
            break;


        case "ajouter_pdf":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $pdf = $_FILES['pdfFile'];
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $profController->ajouter_pdf($pdf, $matiere, $theme);
            }
            break;

        case "supprimer_pdf":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $pdfNom = $_POST['pdf_nom'];
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $profController->supprimer_pdf($pdfNom, $matiere, $theme);
            }
            break;

        case "ajouter_video":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $videoLien = $_POST['video_lien'];
                $videoNom = $_POST['video_nom'];
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $profController->ajouter_video($videoLien, $videoNom, $matiere, $theme);
            }
            break;

        case "supprimer_video":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $videoLien = $_POST['video_lien'];
                $videoNom = $_POST['video_nom'];
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $profController->supprimer_video($videoLien, $videoNom, $matiere, $theme);
            }
            break;

        case "ajouter_quizz":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $quizTitre = $_POST['quiz_titre'];
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $questions = $_POST['questions'];
                $reponses = $_POST['reponses'];
                $BonnesReponses = $_POST['bonne_reponse'];
                $profController->ajouter_quizz($quizTitre, $matiere, $theme, $questions, $reponses, $BonnesReponses);
            }
            break;

        case "modifier_quizz":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $quizTitre = $_POST['quiz_titre'];
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $questions = $_POST['questions'];
                $reponses = array();
                $BonnesReponses = array();
                foreach ($questions as $index => $question) {
                    $reponses[$index] = $question['reponses'];
                    $BonnesReponses[$index] = $question['bonne_reponse'];
                }
                print_r($reponses);
                $profController->modifier_quizz($quizTitre, $matiere, $theme, $questions, $reponses, $BonnesReponses);
            }
            break;

        case "supprimer_quizz":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs') {
                $matiere = $_POST['matiere'];
                $theme = $_POST['theme'];
                $quizzId = $_POST['quiz_id'];
                $profController->supprimer_quizz($quizzId, $matiere, $theme);
            }
            break;
        case "cours_eleves":
            if (isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Eleves') {
                $eleveController->cours();
                break;
            }
        case "creer_forum":
            if(isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Eleves'){
                $matiere = $_POST['matiere'];
                $titre = $_POST['titre'];
                $question = $_POST['question'];
                $theme = $_POST['theme'];
                $mecQuiPoseLaQuestion = $_SESSION['profil']['email'];
                $eleveController->ajouter_forum($matiere, $titre, $question, $mecQuiPoseLaQuestion, $theme);
                break;
            }elseif(isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs'){
                $matiere = $_POST['matiere'];
                $titre = $_POST['titre'];
                $question = $_POST['question'];
                $theme = $_POST['theme'];
                $mecQuiPoseLaQuestion = $_SESSION['profil']['email'];
                $profController->ajouter_forum($matiere, $titre, $question, $mecQuiPoseLaQuestion, $theme);
                break;
            }
        case "repondre_forum":
            if(isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Eleves'){
                $matiere = $_POST['matiere'];
                $titre = $_POST['titre'];
                $reponse = $_POST['reponse'];
                $theme = $_POST['theme'];
                $mecQuiRepond = $_SESSION['profil']['email'];
                $eleveController->repondre_forum($matiere, $theme, $reponse, $titre, $mecQuiRepond);
                break;
            }elseif(isset($_SESSION['profil']['role']) && $_SESSION['profil']['role'] === 'Profs'){
                $matiere = $_POST['matiere'];
                $titre = $_POST['titre'];
                $reponse = $_POST['reponse'];
                $theme = $_POST['theme'];
                $mecQuiRepond = $_SESSION['profil']['email'];
                $profController->repondre_forum($matiere, $theme, $reponse, $titre, $mecQuiRepond);
                break;
            }
    }
} catch (Exception $e) {
    echo ("La page n'existe pas");
}
