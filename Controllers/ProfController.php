<?php

require_once("./Models/ProfModel.php");
require_once("./Controllers/MainController.php");

class ProfController extends MainController{
    private $ProfModel;
    public function __construct(){
        $this->ProfModel = new ProfModel();
    }

    public function cours(){
        $matieres=$this->ProfModel->getInfos();
        $pdf=$this->ProfModel->getPdfs();
        $data_page=[
            "page_description"=>"Gestion des droits",
            "page_title"=>"Gestion des droits",
            "matieres"=>$matieres,
            "pdf"=>$pdf,
            "view"=>"Views/CoursProf.view.php",
            "template"=>"Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function ajouter_pdf($pdf,$matiere,$theme){
        $this->ProfModel->ajouterPdf($pdf);
        $this->ProfModel->ajouterPdfBdd($pdf['name'],$matiere,$theme);
        header("Location: ".URL."cours");
    }

    public function supprimer_pdf($pdfNom,$matiere,$theme){
        $this->ProfModel->supprimerPdf($pdfNom);
        $this->ProfModel->supprimerPdfBdd($pdfNom,$matiere,$theme);
        header("Location: ".URL."cours");
    }

    public function ajouter_video($videoLien,$videoNom,$matiere,$theme){
        $this->ProfModel->ajouterVideo($videoLien,$videoNom,$matiere,$theme);
        header("Location: ".URL."cours");
    }

    public function supprimer_video($videoLien,$videoNom,$matiere,$theme){
        $this->ProfModel->supprimerVideo($videoLien,$videoNom,$matiere,$theme);
        header("Location: ".URL."cours");
    }

    public function ajouter_quizz($quizTitre, $matiere, $theme, $questions, $reponses, $BonnesReponses){
        $this->ProfModel->ajouterQuizz($quizTitre, $matiere, $theme, $questions, $reponses, $BonnesReponses);
        header("Location: ".URL."cours");
    }

    public function modifier_quizz($quizTitre, $matiere, $theme, $questions, $reponses, $BonnesReponses){
        $this->ProfModel->modifierQuizz($quizTitre, $matiere, $theme, $questions, $reponses, $BonnesReponses);
        header("Location: ".URL."cours");
    }

    public function supprimer_quizz($quizzId, $matiere, $theme){
        $this->ProfModel->supprimerQuizz($quizzId, $matiere, $theme);
        header("Location: ".URL."cours");
    }

    public function ajouter_forum($matiere, $titreForum, $questionForum, $mecQuiPoseLaQuestion, $theme){
        $this->ProfModel->creerForum($matiere, $titreForum, $questionForum, $mecQuiPoseLaQuestion, $theme);
        header("Location: ".URL."cours");
    }

    public function repondre_forum($matiereInt, $theme, $reponse, $titreForum, $mecQuiRepond){
        $this->ProfModel->repondreForum($matiereInt, $theme, $reponse, $titreForum, $mecQuiRepond);
        header("Location: ".URL."cours");
    }
}