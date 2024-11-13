<?php
require_once("./Models/db.class.php");

class VisiteurModel extends db
{
    private function getPasswordUser($email)
    {
        $req = "SELECT psw, role FROM users WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ['psw'=>$resultat['psw'],
        'role'=>$resultat['role']];
    }

    public function connexionValide($email, $password)
    {
        $data = $this->getPasswordUser($email);
        $passwordBD=$data['psw'];
        $role=$data['role'];
        if(password_verify($password,$passwordBD)){
            echo("a");
            return $role;
        }
        return null;
    }

    public function inscription($nom,$prenom,$email,$telephone,$info,$password){
        $req = "INSERT INTO users(email,psw,tel,infos,nom,prenom) VALUES (:email, :psw, :tel, :infos, :nom, :prenom)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":psw", $password, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":tel",$telephone,PDO::PARAM_STR);
        $stmt->bindValue(":infos",$info,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
