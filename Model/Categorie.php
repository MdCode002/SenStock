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
            $result.="
             <tr>
                <td>".$value[1]."</td>
                <td>".$value[2]."</td>
                <td><button href='".$value[0]."'>Supprimer</button></td>
                <td><button href='".$value[0]."'>Modifier</button></td>
            </tr>";
       }
       return $result;
    }

}
