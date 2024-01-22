<?php
require_once "ModeleAbstrait.php";

Class Categorie extends ModeleAbstrait {
  
    public function save($c = array()) {
        if (!empty($c)) {
            $nom = mysqli_real_escape_string($this->connection, $c[0]);
            $description = mysqli_real_escape_string($this->connection, $c[1]);

            $sql = "INSERT INTO categorie (nom_categorie,description) VALUES ('$nom', '$description')";
            mysqli_query($this->connection, $sql);
            header("Location: categories.php");

           
        }
    }
    public function Update($c = array()) {
        if (!empty($c)) {
            $nom = mysqli_real_escape_string($this->connection, $c[0]);
            $description = mysqli_real_escape_string($this->connection, $c[1]);
            $id = mysqli_real_escape_string($this->connection, $c[2]);

            $sql = $sql = "UPDATE categorie SET nom_categorie = '$nom', description = '$description' WHERE idcategorie = '$id'";
            ;
            mysqli_query($this->connection, $sql);
            header("Location: categories.php");
           
        }
    }

    public function readAll(){
        $sql = "SELECT * FROM categorie";
        return mysqli_query($this->connection, $sql)->fetch_all();
    }
    public function readOne($id){
        $id = mysqli_real_escape_string($this->connection, $id);
        $sql = "SELECT * FROM categorie where idcategorie = '$id'";
        return mysqli_query($this->connection, $sql)->fetch_assoc();
    }
    public function print($data){
        $result = "";
       
       foreach ($data as $key => $value) {
        $produit = $this->GetProduitCategorie($value[0]);
        $result .= "
                <tr>
                    <td>".$value[1]."</td>
                    <td>".$value[2]."</td> 
                    <td><a href='./Categories.php?action=modifier&id=".$value[0]."'>Modifier</a></td>
                    <td>
                    <a href='./Categories.php?action=supprimer&id=".$value[0]."' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ".$value[1]." ? ".(!empty($produit) ? ' '.count($produit).' produit(s) sont associé(s) à cette catégorie et seront aussi supprimés.' : '')."\");'> Supprimer </a>
                    </td>
                </tr>";

       }
       return $result;
    }
    public function Deletecategorie($id, $Classproduit){
        if ($id >= 0) {
            $Id = mysqli_real_escape_string($this->connection, $id);
            $produits = $this->GetProduitCategorie($Id);
            
            foreach ($produits as $produit) {
                $produitId = mysqli_real_escape_string($this->connection, $produit[0]);
                $Classproduit->DeleteProduit($produitId);
            }
    
            $sql = "DELETE FROM categorie WHERE idcategorie = $Id";
            mysqli_query($this->connection, $sql);
            header("Location: ./Categories.php");
        }
    }
    

    public function GetProduitCategorie($id){
        $sql = "SELECT idproduit FROM produits WHERE categorie_id = $id";
        return mysqli_query($this->connection, $sql)->fetch_all();
    }

}
