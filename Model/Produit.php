<?php
require_once "ModeleAbstrait.php";
Class Produit extends ModeleAbstrait {
    public function readAll(){
        $sql = "SELECT * FROM produits";
        return mysqli_query($this->connection, $sql)->fetch_all();
    }
    public function readOne($id){
        $sql = "SELECT * FROM produits WHERE idproduit = $id";
        return mysqli_query($this->connection, $sql)->fetch_assoc();
    }

    public function GetCategories($id){
        $sql = "SELECT nom_categorie FROM categorie WHERE idcategorie = ".$id;
        return mysqli_query($this->connection, $sql)->fetch_assoc();
    }

    public function print($data){
        $result = "";
       foreach ($data as $key => $value) {
        $result .= "
                <tr>
                    <td>" . $value[1] . "</td>
                    <td>" . $this->GetCategories($value[2])["nom_categorie"] . "</td>
                    <td>" . $value[3] . "</td>
                    <td>" . $value[4] . "</td>
                    <td>" . $value[5] . "</td>
                    <td><a class='modifierbtn' href='./Produits.php?action=modifier&id=" . $value[0] . "'>Modifier</a></td>
                    <td><a class='supprimerbtn' href='./Produits.php?action=supprimer&id=" . $value[0] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer " . $value[1] . " ?\");'>Supprimer</a></td>
                </tr>";
    
       }
       return $result;
    }

    public function printSelect($data, $selectedValue){
        $result = "";
       foreach ($data as $key => $value) {
        if ($selectedValue == $value[0]) {
        $result .= " <option value=" . $value[0] . " selected >" . $value[1] . "</option>";
        } else {
            $result .= " <option value=" . $value[0] . ">" . $value[1] . "</option>"; 
        }
       }
       return $result;
    }

    public function DeleteProduit($id){
        if($id >= 0 ){
            $Id = mysqli_real_escape_string($this->connection, $id);
            $sql = "DELETE FROM produits WHERE idproduit   = $Id";
            mysqli_query($this->connection, $sql);
            header( "Location:  ./Produits.php");
        }
    }
    public function save($c = array()) {
        if (!empty($c)) {
            $nom = mysqli_real_escape_string($this->connection, $c[0]);
            $Categorie = mysqli_real_escape_string($this->connection, $c[1]);
            $Description = mysqli_real_escape_string($this->connection, $c[2]);
            $Quantite  = mysqli_real_escape_string($this->connection, $c[3]);
            $Prix   = mysqli_real_escape_string($this->connection, $c[4]);

            $sql = "INSERT INTO `produits` (`nom_produit`, `categorie_id`, `qte`, `prix_unitaire`, `description`) VALUES (' $nom', '$Categorie ', '$Quantite ', '$Prix', '$Description ')";
            mysqli_query($this->connection, $sql);
            header("Location: produits.php");

           
        }
    }
    public function Update($c = array()) {
        if (!empty($c)) {
            $nom = mysqli_real_escape_string($this->connection, $c[0]);
            $Categorie = mysqli_real_escape_string($this->connection, $c[1]);
            $Description = mysqli_real_escape_string($this->connection, $c[2]);
            $Quantite  = mysqli_real_escape_string($this->connection, $c[3]);
            $Prix   = mysqli_real_escape_string($this->connection, $c[4]);
            $id   = mysqli_real_escape_string($this->connection, $c[5]);

            $sql = $sql = "UPDATE produits SET nom_produit = '$nom', categorie_id = '$Categorie', qte = '$Quantite', description = '$Description', prix_unitaire = '$Prix' WHERE idproduit  = '$id'";
            ;
            mysqli_query($this->connection, $sql);
            header("Location: produits.php");
           
        }
    }
    

}
