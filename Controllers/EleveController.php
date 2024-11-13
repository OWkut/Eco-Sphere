<?php
require_once("./Models/EleveModel.php");
require_once("./Controllers/MainController.php");

class EleveController extends MainController{
    private $EleveModel;
    public function __construct(){
        $this->EleveModel = new EleveModel();
    }

    public function cours(){
        $matieres=$this->EleveModel->getInfos();
        $pdf=$this->EleveModel->getPdfs();
        $data_page=[
            "page_description"=>"Gestion des droits",
            "page_title"=>"Gestion des droits",
            "matieres"=>$matieres,
            "pdf"=>$pdf,
            "view"=>"Views/CoursEleve.view.php",
            "template"=>"Views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function ajouter_forum($matiereInt, $titreForum, $questionForum, $mecQuiPoseLaQuestion, $theme){
        $this->EleveModel->creerForum($matiereInt, $titreForum, $questionForum, $mecQuiPoseLaQuestion, $theme);
        header("Location: ".URL."cours_eleves");
    }

    public function repondre_forum($matiereInt, $theme, $reponse, $titreForum, $mecQuiRepond){
        $this->EleveModel->repondreForum($matiereInt, $theme, $reponse, $titreForum, $mecQuiRepond);
        header("Location: ".URL."cours_eleves");
    }
}