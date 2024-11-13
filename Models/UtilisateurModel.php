<?php
require_once("./Models/db.class.php");

class UtilisateurModel extends db
{
    public function getAnnoncesEchanges(): mixed{
        $req = $this->getBdd()->prepare("
        SELECT offre.*,
        users.email,
        offre_reponse.user_id,
        offre_reponse.reponse_message,
        offre_reponse.date_reponse
        FROM offre
        INNER JOIN users
        ON offre.user_id = users.id
        LEFT JOIN offre_reponse
        ON offre.id = offre_reponse.offre_id;
    ");
    $req->execute();
    $datas = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    
    // Structuration des données par offre avec leurs réponses
    $offres = [];
    foreach ($datas as $data) {
        $offreId = $data['id'];
        if (!isset($offres[$offreId])) {
            $offres[$offreId] = [
                'id' => $offreId,
                'item_offert' => $data['item_offert'],
                'description' => $data['description'],
                'date_creation' => $data['date_creation'],
                'email' => $data['email'],
                'responses' => []
            ];
        }
        
        // Ajouter la réponse si elle existe
        if ($data['reponse_message']) {
            $offres[$offreId]['responses'][] = [
                'userReponder' => $data['email'],
                'message' => $data['reponse_message'],
                'date' => $data['date_reponse']
            ];
        }
    }

    return $offres;
    }

    private function recupId($email){
        $req = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['id'];
    }

    public function creer_echange($item_offert, $description, $date){
        $user = $this->recupId($_SESSION['profil']['email']);
        $req = "INSERT INTO offre(user_id, item_offert, description, date_creation) VALUES (:user_id, :item_offert, :description, :date_creation)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":date_creation", $date, PDO::PARAM_STR);
        $stmt->bindValue(":item_offert", $item_offert, PDO::PARAM_STR);
        $stmt->bindValue(":user_id", $user, PDO::PARAM_INT);
        $stmt->execute();
        $offreId = $this->getBdd()->lastInsertId();
        if (isset($_FILES['images']) && $_FILES['images']['error'][0] == 0) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $fileType = mime_content_type($tmp_name);
                if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $uploadDir = '/Public/images/';
                    $fileName = uniqid() . '-' . basename($_FILES['images']['name'][$key]);
                    $uploadPath = $uploadDir . $fileName;
                    if (move_uploaded_file($tmp_name, $uploadPath)) {
                        $reqImage = "INSERT INTO images_echange(offre_id, chemin) VALUES (:offre_id, :chemin)";
                        $stmtImage = $this->getBdd()->prepare($reqImage);
                        $stmtImage->bindValue(":offre_id", $offreId, PDO::PARAM_INT);
                        $stmtImage->bindValue(":chemin", $uploadPath, PDO::PARAM_STR);
                        $stmtImage->execute();
                        $stmtImage->closeCursor();
                    }
                }
            }
        }
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function creer_reponse($id_offre, $reponse, $date){
        $user = $this->recupId($_SESSION['profil']['email']);
        $req = "INSERT INTO offre_reponse(offre_id, user_id, reponse_message, date_reponse) VALUES (:offre_id, :user_id, :reponse_message, :date_reponse)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":offre_id", $id_offre, PDO::PARAM_INT);
        $stmt->bindValue(":user_id", $user, PDO::PARAM_INT);
        $stmt->bindValue(":reponse_message", $reponse, PDO::PARAM_STR);
        $stmt->bindValue(":date_reponse", $date, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = $stmt->rowCount() > 0;
        $stmt->closeCursor();
        return $estModifier;
    }
    


    public function ajouterAnnonce($titre, $type_logement, $prix, $description, $ville, $adresse, $proximite, $surface) {
        $id = $this->recupId($_SESSION['profil']['email']);
        $req = "INSERT INTO logements(type_logement, description, prix, surface, adresse, ville, proprietaire_id, proximite) 
                VALUES (:type_logement, :description, :prix, :surface, :adresse, :ville, :proprietaire_id, :proximite)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":type_logement", $type_logement, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":prix", $prix, PDO::PARAM_STR);
        $stmt->bindValue(":surface", $surface, PDO::PARAM_INT);
        $stmt->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":ville", $ville, PDO::PARAM_STR);
        $stmt->bindValue(":proprietaire_id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":proximite", $proximite, PDO::PARAM_STR);
        $stmt->execute();
        $logementId = $this->getBdd()->lastInsertId();
        $reqAnnonce = "INSERT INTO annonces(logement_id, titre) VALUES (:logement_id, :titre)";
        $stmtAnnonce = $this->getBdd()->prepare($reqAnnonce);
        $stmtAnnonce->bindValue(":logement_id", $logementId, PDO::PARAM_INT);
        $stmtAnnonce->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmtAnnonce->execute();
    if (isset($_FILES['images']) && $_FILES['images']['error'][0] == 0) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $fileType = mime_content_type($tmp_name);
            if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                $uploadDir = 'Public/images/';
                $fileName = uniqid() . '-' . basename($_FILES['images']['name'][$key]);
                $uploadPath = $uploadDir . $fileName;
                if (move_uploaded_file($tmp_name, $uploadPath)) {
                    $reqImage = "INSERT INTO images_logement(logement_id, chemin) VALUES (:logement_id, :chemin)";
                    $stmtImage = $this->getBdd()->prepare($reqImage);
                    $stmtImage->bindValue(":logement_id", $logementId, PDO::PARAM_INT);
                    $stmtImage->bindValue(":chemin", $uploadPath, PDO::PARAM_STR);
                    $stmtImage->execute();
                    $stmtImage->closeCursor();
                }
            }
        }
    }
        $estModifier = ($stmt->rowCount() > 0 && $stmtAnnonce->rowCount() > 0);
        $stmt->closeCursor();
        $stmtAnnonce->closeCursor();
        return $estModifier;
    }
    
    public function getAnnonces($type_logement = '', $prix_max = '', $ville = '') {
        // Requête de base
        $req = "SELECT annonces.id AS annonce_id, annonces.titre, annonces.date_publication, logements.type_logement, 
                logements.prix, logements.description, logements.ville, logements.surface, logements.adresse, logements.proximite
                FROM annonces
                JOIN logements ON annonces.logement_id = logements.id
                WHERE annonces.disponible = 1";
    
        // Ajouter des filtres à la requête si des valeurs sont fournies
        $conditions = [];
        $params = [];
    
        // Filtre sur le type de logement
        if ($type_logement !== '') {
            $conditions[] = "logements.type_logement = :type_logement";
            $params[':type_logement'] = $type_logement;
        }
    
        // Filtre sur le prix maximum
        if ($prix_max !== '') {
            $conditions[] = "logements.prix <= :prix_max";
            $params[':prix_max'] = $prix_max;
        }
    
        // Filtre sur la ville
        if ($ville !== '') {
            $conditions[] = "logements.ville LIKE :ville";
            $params[':ville'] = '%' . $ville . '%';  // Utilisation de LIKE pour permettre la recherche par sous-chaînes
        }
    
        // Si des conditions de filtre ont été ajoutées, les intégrer dans la requête SQL
        if (count($conditions) > 0) {
            $req .= " AND " . implode(" AND ", $conditions);
        }
    
        // Préparer et exécuter la requête
        $stmt = $this->getBdd()->prepare($req);
    
        // Lier les paramètres
        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }
    
        // Exécuter la requête
        $stmt->execute();
    
        // Récupérer les résultats
        $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Fermer le curseur pour libérer la connexion
        $stmt->closeCursor();
    
        return $annonces;
    }
    
    
    public function infoAnnonce($id){
        $req = "SELECT annonces.id AS annonce_id, annonces.titre, annonces.date_publication, logements.type_logement, logements.prix, logements.description, logements.ville, logements.surface, logements.adresse, logements.proximite, users.nom,users.prenom,users.email, users.tel, images_logement.chemin AS image_chemin FROM annonces JOIN logements ON annonces.logement_id = logements.id LEFT JOIN images_logement ON logements.id = images_logement.logement_id JOIN users ON logements.proprietaire_id = users.id WHERE annonces.id = :annonce_id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":annonce_id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $annonce = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $annonce;
    }
    
}