<?php
 require_once ("./Model/Categorie.php");
 require_once ("./Model/Produit.php");
 $categorie = new Categorie();
 $Produit = new Produit();
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
    <main>
        
    </main>
    <section class="section1">
        <a href="./Categories.php">
            <div class="countBox">
                <div class="label">
                    <img src="./img/Category.png" alt="" width="60px"> 
                    <h2>Categories</h2>
                </div>
                <div class="count">
                    <h1  class="hidecountnub">  <?php echo $categorie->count() ?> </h1>
                    <h1  class="countnub"></h1>
                </div>
            </div>
        </a>

        <a href="./Produits.php">
            <div class="countBox">
            <div class="label">
                    <img src="./img/Produit.png" alt="" width="60px"> 
                    <h2>Produits</h2>
                </div>
                <div class="count">
                    <h1  class="hidecountnubP">  <?php echo $Produit->count() ?> </h1>
                    <h1  class="countnubP"></h1>
                </div>
            </div>
        </a>
    </section>
    <script src="./js/script.js"></script>
</body>
</html>