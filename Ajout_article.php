<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'article</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
   
    <div class="container">
        <h3 class="">Ajouter une article</h3>
         <!--Formulaire-->
         <form action="traitement_article.php" enctype="multipart/form-data" class="form-group col-6" method="post">
                <table>
                    <tr>
                        <td>
                            <!--Champ du titre-->
                            <label for="titre">Titre</label>
                            <input type="text" placeholder="Saisir le titre" class="form-control" name="titre" id="titre">
                            <?php
                                if(isset($_SESSION['erreur_art']['titre']) AND !empty($_SESSION['erreur_art']['titre'])){
                                    echo $_SESSION['erreur_art']['titre'];
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <!--Champ de la description -->
                            <label for="descri">Description</label>
                           <textarea name="descri" placeholder="Mettez votre description" class="form-control" id="descri" cols="30" rows="2"></textarea>
                           <?php
                                if(isset($_SESSION['erreur_art']['descri']) AND !empty($_SESSION['erreur_art']['descri'])){
                                    echo $_SESSION['erreur_art']['descri'];
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <!--Champ de l'image-->
                            <label for="img">Insérer une image</label>
                            <input type="file" class="form-control" name="img" id="img">
                            <?php
                                if(isset($_SESSION['erreur_art']['image']) AND !empty($_SESSION['erreur_art']['image'])){
                                    echo $_SESSION['erreur_art']['image'];
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <!--Les boutons annuler et soumettre-->
                            <input type="reset" class="btn-danger" value="Annuler">
                            <input type="submit" class="btn-primary" value="Ajouter">
                        </td>
                    </tr>



                </table>


         </form>



    </div>

</body>
</html>