<?php
 require_once ("./Model/Categorie.php");
 require_once ("./Model/Produit.php");
 $categorie = new Categorie();
 $Produit = new Produit();


 $action = isset($_GET['action']) ? $_GET['action'] : '';
 $id = isset($_GET['id']) ? $_GET['id'] : '';

 if ($action =="supprimer" && !empty($id)){
    $categorie->Deletecategorie($id,$Produit );
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
            <h1>Categories</h1>
        </section>
        <section class="tableBody">
            <table>
                <thead>
                    <tr>
                        <th>Nom categorie</th>
                        <th>Description</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                 <?php echo $categorie->print($categorie->readAll()) ?>                          </tbody>
            </table>
        </section>
    </main>
    <button class="addBtn"id="addCategories"> <h4>Ajouter une categorie</h4></button>
    </center>
    <section class="HideForm">
       <div class="SubHideForm">
            <img src="./img/cancel.png" class="cancel" alt="">
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

addBtn.addEventListener('click',()=>{
    HideForm.style.display = "inherit";
})
cancel.addEventListener('click',()=>{
    HideForm.style.display = "none";
})

</script>