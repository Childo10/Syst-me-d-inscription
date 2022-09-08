<?php
try 
{
    $bdd= new PDO('mysql:host=localhost; dbname=test','root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} 
catch (Exception $e) 
{
    die('Erreur= '. $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        <?php 
    
            if(isset($_GET['success']) AND !empty($_GET['success'])){
                echo$_GET['success'];
            }
        ?>
              </p>

    <div>
    <?php
        $requete=$bdd->query('SELECT * FROM article ORDER BY ID DESC');
        while($donnees=$requete->fetch()){
            echo  '<h1 class="display-4">'.$donnees['Titre'] .'</h1><br>
            
             <p class="lead">' .$donnees['Descrip'].'</p>';
           echo $donnees['Img'];
        }
    ?>
    </div>
</body>
</html>



