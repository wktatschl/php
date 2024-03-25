<?php
class AnimalDAO {

    public static function getAnimauxBD(){
        $pdo = MonPDO::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM animal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTypeAnimal($idAnimal){
        $pdo = MonPDO::getPDO();
        $stmt = $pdo->prepare(
            "SELECT libelle 
            FROM type t
            INNER JOIN animal a ON t.idType = a.idType
            WHERE a.idAnimal = :idAnimal");
        $stmt->bindValue(':idAnimal', $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $res['libelle'];

    }

    public static function getImagesAnimal($idAnimal){
        $pdo = MonPDO::getPDO();
        $stmt = $pdo->prepare(
            "SELECT libelle, url 
            FROM image i
            INNER JOIN image_animal ia ON i.idImage = ia.idImage
            WHERE ia.idAnimal = :idAnimal");
        $stmt->bindValue(':idAnimal', $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}