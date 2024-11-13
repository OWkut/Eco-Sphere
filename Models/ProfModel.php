<?php
require_once("./models/db.class.php");

class ProfModel extends db
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
                        if (isset($matiere['Profs']) && !empty($matiere['Profs']) && in_array($_SESSION['profil']['email'], $matiere['Profs'])) {
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
        }
        return $data;
    }

    public function ajouterPdfBdd($nom, $matiereInt, $theme)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $theme) {
                foreach ($theme['Matieres'] as $matiereIndex => $matiere) {
                    if ($matiere['intitule'] === $matiereInt) {
                        if (!isset($matiere['contenu'])) {
                            $matiere['contenu'] = [];
                        }
                        $pdfIndex = count($matiere['contenu']) + 1;
                        $matiere['contenu'][$pdfIndex] = $nom;
                        $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                        return true;
                    }
                }
            }
        }
    }


    public function ajouterPdf($pdf)
    {
        $storage = $this->getStorage();
        $bucket = $storage->getBucket();
        $firebasePath = $_SESSION['profil']['email'] . '/pdf/' . $pdf['name'];
        $bucket->upload(
            fopen($pdf['tmp_name'], 'r'),
            [
                'name' => $firebasePath,
            ]
        );
    }

    public function getPdfs()
    {
        $path = $_SESSION['profil']['email'] . '/pdf/';
        $storage = $this->getStorage();
        $bucket = $storage->getBucket();

        $data = [];
        $objects = $bucket->objects([
            'prefix' => $path,
            'delimiter' => '/'
        ]);
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

    public function supprimerPdf($pdfNom)
    {
        $storage = $this->getStorage();
        $bucket = $storage->getBucket();
        $firebasePath = $_SESSION['profil']['email'] . '/pdf/' . $pdfNom;
        $object = $bucket->object($firebasePath);
        $object->delete();
    }

    public function supprimerPdfBdd($pdfNom, $matiereInt, $theme)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $themeData) {
                if ($themeData['intitule'] === $theme) {
                    foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                        if ($matiere['intitule'] === $matiereInt) {
                            $contenu = $matiere['contenu'];
                            foreach ($contenu as $pdfKey => $pdfValue) {
                                if ($pdfValue === $pdfNom) {
                                    unset($contenu[$pdfKey]);
                                    $matiere['contenu'] = array_values($contenu);
                                    $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function ajouterVideo($videoLien, $videoNom, $matiereInt, $theme)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $theme) {
                foreach ($theme['Matieres'] as $matiereIndex => $matiere) {
                    if ($matiere['intitule'] === $matiereInt) {

                        if (!isset($matiere['video'])) {
                            $matiere['video'] = [];
                        }
                        $matiere['video'][] = [
                            'lien' => $videoLien,
                            'nom' => $videoNom,
                        ];
                        $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                        return true;
                    }
                }
            }
        }
    }

    public function supprimerVideo($videoLien, $videoNom, $matiereInt, $theme)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $themeData) {
                if ($themeData['intitule'] === $theme) {
                    foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                        if ($matiere['intitule'] === $matiereInt) {
                            $video = $matiere['video'];
                            foreach ($video as $videoKey => $videoValue) {
                                print_r($videoValue);
                                if ($videoValue['nom'] === $videoNom) {
                                    unset($video[$videoKey]);
                                    $matiere['video'] = $video;
                                    $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function ajouterQuizz($quizTitre, $matiereInt, $theme, $questions, $reponses, $BonnesReponses)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $themeData) {
                if ($themeData['intitule'] === $theme) {
                    foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                        if ($matiere['intitule'] === $matiereInt) {
                            if (!isset($matiere['quizz'])) {
                                $matiere['quizz'] = [];
                            }
                            $quizData = [
                                'titre' => $quizTitre,
                                'questions' => []
                            ];
                            foreach ($questions as $index => $question) {
                                $questionData = [
                                    'texte' => $question,
                                    'reponses' => [],
                                    'bonne_reponse' => $BonnesReponses[$index]
                                ];
                                foreach ($reponses[$index] as $reponse) {
                                    $questionData['reponses'][] = $reponse;
                                }
                                $quizData['questions'][] = $questionData;
                            }
                            $matiere['quizz'][] = $quizData;
                            $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                            return true;
                        }
                    }
                }
            }
        }
    }

    public function modifierQuizz($quizTitre, $matiereInt, $theme, $questions, $reponses, $BonnesReponses)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $themeData) {
                if ($themeData['intitule'] === $theme) {
                    foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                        if ($matiere['intitule'] === $matiereInt) {
                            foreach ($matiere['quizz'] as $quizIndex => $quiz) {
                                if ($quiz['titre'] === $quizTitre) {
                                    $matiere['quizz'][$quizIndex]['titre'] = $quizTitre;
                                    $QuestionsExistantes = $matiere['quizz'][$quizIndex]['questions'];
                                    $nouvellesQuestions = [];
                                    foreach ($questions as $index => $question) {
                                        $updatedQuestion = [
                                            'texte' => $question['texte'],
                                            'reponses' => $reponses[$index],
                                            'bonne_reponse' => $BonnesReponses[$index],
                                        ];
                                        if (array_key_exists($index, $QuestionsExistantes)) {
                                            $QuestionsExistantes[$index] = $updatedQuestion;
                                        } else {
                                            $nouvellesQuestions[] = $updatedQuestion;
                                        }
                                    }
                                    foreach ($QuestionsExistantes as $indexExistant => $QuestionsExistante) {
                                        if (!array_key_exists($indexExistant, $questions)) {
                                            unset($QuestionsExistantes[$indexExistant]);
                                        }
                                    }
                                    $matiere['quizz'][$quizIndex]['questions'] = array_merge($QuestionsExistantes, $nouvellesQuestions);
                                    $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function supprimerQuizz($quizzId, $matiereInt, $theme)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $themeData) {
                if ($themeData['intitule'] === $theme) {
                    foreach ($themeData['Matieres'] as $matiereIndex => $matiere) {
                        if ($matiere['intitule'] === $matiereInt) {
                            $quizz = $matiere['quizz'];
                            unset($quizz[$quizzId]);
                            $matiere['quizz'] = array_values($quizz);
                            $this->getBdd()->getReference("Themes/$themeId/Matieres/$matiereIndex")->set($matiere);
                            return true;
                        }
                    }
                }
            }
        }
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
