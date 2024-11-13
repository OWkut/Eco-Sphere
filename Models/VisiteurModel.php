<?php
require_once("./models/db.class.php");

class VisiteurModel extends db
{

    public function creer_compte($email, $password)
    {
        $postData = [
            'email' => $email,
            'psw' => $password,
        ];
        $ref_table = "Users/Eleves";
        $this->getBdd()->getReference($ref_table)->push($postData);
    }

    public function connexion($email, $password)
    {
        $roles = ['Admins', 'Eleves', 'Profs'];
        foreach ($roles as $role) {
            $userData = $this->getUserData($role, $email);
            if ($userData) {
                $passwordBD = $userData['userData']['psw'];
                if ($password === $passwordBD) {
                    $_SESSION['profil'] = [
                        "email" => $email,
                        "role" => $role
                    ];
                    return true;
                }
            }
        }
    }

    private function getUserData($role, $email)
    {
        $reference = $this->getBdd()->getReference("Users/" . $role);
        $users = $reference->getValue();
        if ($users) {
            foreach ($users as $userId => $userData) {
                if (isset($userData['email']) && $userData['email'] === $email) {
                    echo "<script>console.log('" . $email . "');</script>";
                    return ['userData' => $userData, 'role' => $role];
                }
            }
        }
        return null;
    }
}
