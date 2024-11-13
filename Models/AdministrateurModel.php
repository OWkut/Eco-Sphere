<?php
require_once("./Models/db.class.php");

class AdministrateurModel extends db
{

    public function getUtilisateurs()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM users");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function modifier_role($nouveauRole, $email){
        $req = "UPDATE users SET role = :nouveauRole WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nouveauRole", $nouveauRole, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public function supprimer_utilisateur($email){
        $req="DELETE FROM users WHERE email = :email";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function supprimerAnnonce($annonce_id) {
        $req = "DELETE FROM annonces WHERE id = :annonce_id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':annonce_id', $annonce_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
}
