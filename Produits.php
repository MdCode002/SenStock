<?php
 require_once ("./Model/Produit.php");
 require_once ("./Model/Categorie.php");
 $categorie = new Categorie();
 $Produit = new Produit();
 $action = isset($_GET['action']) ? $_GET['action'] : '';
 $id = isset($_GET['id']) ? $_GET['id'] : '';

 if ($action =="supprimer" && !empty($id)){
    $Produit->DeleteProduit($id);
 }
 
 if (isset($_POST['nom']) && $_POST['categorie'] && $_POST['description'] && $_POST['Quantite'] && $_POST['Prix']){
    if (!empty($_POST['idProduit'])){

        $Produit->Update([$_POST['nom'], $_POST['categorie'] ,$_POST['description'],$_POST['Quantite'],$_POST['Prix'],$_POST['idProduit']]);

    }else{
        $Produit->save([$_POST['nom'], $_POST['categorie'] ,$_POST['description'],$_POST['Quantite'],$_POST['Prix']]);

    }
    
}

if ($action =="modifier" && !empty($id)){
   $data = $Produit->readOne($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
    <center> <a href="./index.php"><img src="./img/logo.png" alt="" width="170px"></a></center> 
    </header>
    <center>
    <main class="table">
        <section class="tableHeader">
            <h1>Produits</h1>
        </section>
        <section class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>Nom produit</th>
                        <th>Categorie</th>
                        <th>Quantite</th>
                        <th>Pix unitaire</th>
                        <th>Description</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                 <?php echo $Produit->print($Produit->readAll()) ?> </tbody>
            </table>
        </section>
    </main>
    <button class="addBtn"id="addCategories"> <h4>Ajouter un produit</h4></button>

    </center>
    <section class="HideForm">
       <div class="SubHideForm">
            <img src="./img/cancel.png" class="cancel" alt="">
            <div class="formSec">
            <h2 class="TitleForm"><?php echo isset($data) ? "Modifier le Produit":"Ajouter un Produit"  ; ?></h2>
                <form action="" method="POST">
                    <label for="nom"><h4>Nom Produit</h4></label>
                    <input type="text" name="nom" id="" required value="<?php echo isset($data) ? $data["nom_produit"] : ""; ?>">
                    <label><h4>Categorie</h4></label>
                    <select class="form-select" name="categorie" required >
                        <?php echo $Produit->printSelect($categorie->readAll(), isset($data) ? $data["categorie_id"] : ""); ?>
                    </select>

                    <label for="description"><h4>Description Produit</h4></label>
                    <input type="text" name="description" id="" required value="<?php echo isset($data) ? $data["description"] : ""; ?>">
                    
                    <label for="qte"><h4>Quantite Produit</h4></label>
                    <input type="number" name="Quantite" id="" required value="<?php echo isset($data) ? $data["qte"] : ""; ?>">
                   
                    <label for="prix"><h4>Prix Produit</h4></label>
                    <input type="text" name="Prix" id="" required value="<?php echo isset($data) ? $data["prix_unitaire"] : ""; ?>">
                   

                    <input type="hidden" name="idProduit" id="" required value="<?php echo isset($data) ? $data["idproduit"] : ""; ?>">
                    
                    <input type="submit" name="" id="" value="Valider">
                </form>
            </div>
       </div>
    </section>
   
    <script src="./js/script.js"></script>
</body>
</html>
<script>
    // ------------------------------SHOW/Hide FORM-----------------------------------------
let HideForm = document.querySelector('.HideForm');
let addBtn = document.querySelector('.addBtn');
let cancel = document.querySelector('.cancel');
let TitleForm = document.querySelector('.TitleForm');

addBtn.addEventListener('click',()=>{
    HideForm.style.display = "inherit";
    TitleForm.innerHTML = "Ajouter un Produit"
})
cancel.addEventListener('click', () => {
    HideForm.style.display = "none";

    let inputElements = document.querySelectorAll('input');

    inputElements.forEach(element => {
        if (element.type !== "submit") {
            element.value = "";
        }
    });
});


</script>

<?php 
if(isset($data))
echo "<script>  HideForm.style.display = 'inherit' </script>"
?>