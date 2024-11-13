<?php
require_once("./models/db.class.php");

class EleveModel extends db
{

    public function getInfos()
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        $data = [];
        if ($themes) {
            foreach ($themes as $themeId => $theme) {
                if (isset($theme['Matieres'])) {
                    foreach ($theme['Matieres'] as $matiere) {
                            $matiereData = [
                                'themeIntitule' => $theme['intitule'],
                                'description' => $theme['description'],
                                'matiere' => $matiere['intitule'],
                            ];
                            if (isset($matiere['contenu']) && !empty($matiere['contenu'])) {
                                $matiereData['contenu'] = $matiere['contenu'];
                            }
                            if (isset($matiere['video']) && !empty($matiere['video'])) {
                                $matiereData['video'] = $matiere['video'];
                            }
                            if (isset($matiere['quizz']) && !empty($matiere['quizz'])) {
                                $matiereData['quizz'] = $matiere['quizz'];
                            }
                            if (isset($matiere['forum']) && !empty($matiere['forum'])) {
                                $matiereData['forum'] = $matiere['forum'];
                            }
                            $data[] = $matiereData;
                    }
                }
            }
        }
        return $data;
    }

    public function getPdfs()
    {
        $storage = $this->getStorage();
        $bucket = $storage->getBucket();
        $data = [];
        $objects = $bucket->objects();
        foreach ($objects as $object) {
            if (strpos($object->name(), '.pdf') !== false) {
                $fileName = basename($object->name());
                $signedUrl = $object->signedUrl(new \DateTime('+1 hour'));
                $data[] = [
                    'name' => $fileName,
                    'link' => $signedUrl
                ];
            }
        }
        return $data;
    }

    public function creerForum($matiereInt, $titreForum, $questionForum, $mecQuiPoseLaQuestion, $theme){
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        foreach ($themes as $themeId => $themeData) {
            if ($themeData['intitule'] === $theme) {
                foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                    if ($matiere['intitule'] === $matiereInt) {
                        if (!isset($matiere['forum'])) {
                            $matiere['forum'] = [];
                        }
                        $forumData = [
                            'titre' => $titreForum,
                            'question' => $questionForum,
                            'mecQuiPoseLaQuestion' => $mecQuiPoseLaQuestion
                        ];
                        $matiere['forum'][] = $forumData;
                        $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                        return true;
                    }
                }
            }
        }
    }

    public function repondreForum($matiereInt, $theme, $reponse, $titreForum, $mecQuiRepond){
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        print($theme);
        foreach ($themes as $themeId => $themeData) {
            if ($themeData['intitule'] === $theme) {
                foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                    if ($matiere['intitule'] === $matiereInt) {
                        foreach ($matiere['forum'] as $forumIndex => $forum) {
                            if ($forum['titre'] === $titreForum) {
                                if (!isset($forum['reponses'])) {
                                    $forum['reponses'] = [];
                                }
                                $reponseData = [
                                    'reponse' => $reponse,
                                    'mecQuiRepond' => $mecQuiRepond
                                ];
                                $forum['reponse'][] = $reponseData;
                                $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex/forum/$forumIndex")->set($forum);
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
}
