<?php
require_once "ModeleAbstrait.php";

Class Categorie extends ModeleAbstrait {
  
    // public function save($p = array()) {
    //     if (!empty($p)) {
    //         $nom = mysqli_real_escape_string($this->connection, $p["nom"]);
    //         $prenom = mysqli_real_escape_string($this->connection, $p["prenom"]);

    //         $sql = "INSERT INTO usertb (prenom, nom) VALUES ('$nom', '$prenom')";
            
    //         if (mysqli_query($this->connection, $sql)) {
    //             echo "Enregistrement réussi.";
    //         } else {
    //             echo "Erreur lors de l'enregistrement : " . mysqli_error($this->connection);
    //         }
    //     }
    // }

    public function readAll(){
        $sql = "SELECT * FROM categorie";
        return mysqli_query($this->connection, $sql)->fetch_all();
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
                    <a href='./Categories.php?action=supprimer&id=".$value[0]."' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ".$value[1]." ? ".(!empty($produit) ? ' '.$this->count($produit).' produit(s) sont associé(s) à cette catégorie et seront aussi supprimés.' : '')."\");'> Supprimer </a>
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
        $sql = "SELECT * FROM produits WHERE categorie_id = $id";
        return mysqli_query($this->connection, $sql)->fetch_all();
    }

}
