<?php
require_once "ModeleAbstrait.php";
Class Produit extends ModeleAbstrait {
    public function readAll(){
        $sql = "SELECT * FROM produits";
        return mysqli_query($this->connection, $sql)->fetch_all();
    }

    public function GetCategories($id){
        $sql = "SELECT nom_categorie FROM categorie WHERE idcategorie = ".$id;
        return mysqli_query($this->connection, $sql)->fetch_assoc();
    }

    public function print($data){
        $result = "";
       foreach ($data as $key => $value) {
            $result.="
             <tr>
                <td>".$value[1]."</td>
                <td>".$this->GetCategories($value[2])["nom_categorie"]."</td>
                <td>".$value[3]."</td>
                <td>".$value[4]."</td>
                <td>".$value[5]."</td>
                <td><button href='".$value[5]."'>Supprimer</button></td>
                <td><button href='".$value[5]."'>Modifier</button></td>
            </tr>";
       }
       return $result;
    }

}
