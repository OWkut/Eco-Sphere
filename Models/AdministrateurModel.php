<?php
require_once("./models/db.class.php");

class AdministrateurModel extends db
{

    public function getUtilisateurs()
    {
        $roles = ['Admins', 'Eleves', 'Profs'];
        $utilisateurs = [];
        foreach ($roles as $role) {
            $reference = $this->getBdd()->getReference("Users/" . $role);
            $users = $reference->getValue();
            if ($users) {
                foreach ($users as $userId => $userData) {
                    $userData['role'] = $role;
                    $utilisateurs[] = $userData;
                }
            }
        }
        return $utilisateurs;
    }

    public function getUserData($role, $email)
    {
        $reference = $this->getBdd()->getReference("Users/" . $role);
        $users = $reference->getValue();
        if ($users) {
            foreach ($users as $userId => $userData) {
                if (isset($userData['email']) && $userData['email'] === $email) {
                    return ['userData' => $userData, 'role' => $role];
                }
            }
        }
        return null;
    }

    public function modifier_role($role, $userData)
    {
        $reference = $this->getBdd()->getReference("Users/" . $role);
        $newUserRef = $reference->push();
        $newUserRef->set($userData);
    }

    public function supprimer_utilisateur($role, $email)
    {
        $reference = $this->getBdd()->getReference("Users/" . $role);
        $users = $reference->getValue();
        if ($users) {
            foreach ($users as $userId => $userData) {
                if (isset($userData['email']) && $userData['email'] === $email) {
                    $this->getBdd()->getReference("Users/" . $role . "/" . $userId)->remove();
                    return true;
                }
            }
        }
    }

    public function modifierRole($email, $nouveauRole)
    {
        $roles = ['Admins', 'Eleves', 'Profs'];
        foreach ($roles as $role) {
            $userData = $this->getUserData($role, $email);
            if ($userData) {
                $this->modifier_role($nouveauRole, $userData['userData']);
                $this->supprimer_utilisateur($role, $email);
                return true;
            }
        }
    }

    public function getProfs()
    {
        $utilisateurs = [];
        $reference = $this->getBdd()->getReference("Users/Profs");
        $users = $reference->getValue();
        if ($users) {
            foreach ($users as $userId => $userData) {
                $utilisateurs[] = $userData;
            }
        }
        return $utilisateurs;
    }

    public function getThemes()
    {
        $themes = [];
        $reference = $this->getBdd()->getReference("Themes");
        $themesBdd = $reference->getValue();
        if ($themesBdd) {
            foreach ($themesBdd as $themeId => $themeData) {
                $themes[] = $themeData;
            }
        }
        return $themes;
    }

    public function ajouterTheme($nouveauxDetails)
    {
        $this->getBdd()->getReference("Themes")->push($nouveauxDetails);
    }

    public function modifierTheme($intituleActuel, $nouveauxDetails)
    {
        $reference = $this->getBdd()->getReference("Themes");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themeId => $themeData) {
                if (isset($themeData['intitule']) && $themeData['intitule'] === $intituleActuel) {
                    $updatedTheme = [
                        'intitule' => $nouveauxDetails['intitule'],
                        'description' => $nouveauxDetails['description'],
                        'Matieres' => isset($themeData['Matieres']) ? $themeData['Matieres'] : []
                    ];


                    foreach ($nouveauxDetails['matieres'] as $matiereIndex => $matiere) {
                        $matiereData = [
                            'intitule' => $matiere['intitule'],
                            'Profs' => isset($matiere['Profs']) ? $matiere['Profs'] : [],
                            'contenu' =>isset($matiere['contenu']) ? $matiere['contenu'] : [],
                            'contenu' =>isset($matiere['contenu']) ? $matiere['contenu'] : [], 
                        ];

                        $updatedTheme['Matieres'][$matiereIndex] = $matiereData;
                    }

                    if (isset($nouveauxDetails['matieres_a_supprimer']) && !empty($nouveauxDetails['matieres_a_supprimer'])) {
                        $matieresSupprimer = json_decode($nouveauxDetails['matieres_a_supprimer'], true);
                        foreach ($matieresSupprimer as $matieresSup) {
                            foreach ($updatedTheme['Matieres'] as $index => $matiere) {
                                if ($matiere['intitule'] === $matieresSup) {
                                    unset($updatedTheme['Matieres'][$index]);
                                }
                            }
                        }
                    }
                    if (isset($nouveauxDetails['nouvelles_matieres']) && !empty($nouveauxDetails['nouvelles_matieres'])) {
                        $nouvellesMatieres = json_decode($nouveauxDetails['nouvelles_matieres'], true);
                        foreach ($nouvellesMatieres as $matiere) {
                            $matiereData = [
                                'intitule' => $matiere['intitule'],
                                'Profs' => isset($matiere['Profs']) ? $matiere['Profs'] : []
                            ];
                            $updatedTheme['Matieres'][] = $matiereData;
                        }
                    }
                    $this->getBdd()->getReference("Themes/$themeId")->update($updatedTheme);
                    return true;
                }
            }
        }
        return false;
    }

    public function supprimer_theme($intitule)
    {
        $reference = $this->getBdd()->getReference("Themes/");
        $themes = $reference->getValue();
        if ($themes) {
            foreach ($themes as $themesId => $themeData) {
                if (isset($themeData['intitule']) && $themeData['intitule'] === $intitule) {
                    $this->getBdd()->getReference("Themes/" . $themesId)->remove();
                    return true;
                }
            }
        }
    }
}
