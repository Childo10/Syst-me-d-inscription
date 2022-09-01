<?php   
  session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Plugin/bootstrap.css">
    <title>Inscription</title>
</head>
<body> 
    <!--Formulaire d'inscription-->
    <form action="inscription_traitement.php" method="post">
            <h1>Inscription</h1>
    
        <table class="table table-borderless col-3">
            <tr>
                <td>
                    <!--Champ nom-->
                <label for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" id="nom">
                <?php 
                if(isset($_GET['erreur-nom']) AND !empty($_GET['erreur-nom'])) {
                    echo $_GET['erreur-nom'];
                }    
                ?>
                </td>
            </tr>

            <tr>
                <td>
                    <!--Champ prénom-->
                <label for="id">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="prenom">
                <?php if(isset($_GET['erreur-prenom']) AND !empty($_GET['erreur-prenom'])) {
                    echo $_GET['erreur-prenom'];
                }    
                ?>
                </td>
            </tr>

            <tr>
                <td>
                    <!--Champ sexe-->        
                   <label for="M"> Sexe M </label>
                   <input type="radio" value="M" name="sexe" id="M">
                   <label for="F">F</label>
                   <input type="radio" value="F" name="sexe" id="F">
                   <?php 
                    echo $_SESSION['sexe'];
               
                ?> 
                </td>
            </tr>
            
            <tr>
                <td>
                    <!--Champ Age-->
                <label for="age">Age</label>
                <input type="number" name="age" id="age" class="form-control">                
                <?php if(isset($_GET['erreur-age']) AND !empty($_GET['erreur-age'])) {
                    echo $_GET['erreur-age']. '<br>';
                    echo  $_SESSION['erreur_age'];
                }    
                ?>
                </td>
            </tr>

            <tr>
                <td>
                     <!--Champ email-->
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email">
                <?php 
                    echo $_SESSION['email'];
                 
                ?>
                </td>
            </tr>

            <tr>
                <td>
                     <!--Champ Mot de passe-->
                <label for="mdp">Mot de passe</label>
                <input type="password" name="mdp" class="form-control" id="mdp">
                <?php if(isset($_GET['erreur-mdp']) AND !empty($_GET['erreur-mdp'])) {
                    echo $_GET['erreur-mdp'];
                }    
                ?>
                </td>
                
            </tr>
            <tr>
                <td>
                     <!--Bouton pour tout annuler-->
                <input type="reset"  class=" btn-danger" value="Annuler">
                    <!--Bouton pour soumettre-->
                <input type="submit"  class="btn-primary" value="S'inscrire">
                <?php if(isset($_GET['success']) AND !empty($_GET['success'])) {
                    echo $_GET['success'];
                }
                    ?>
                </td>
            </tr>

        </table>
    
    </form>

</body>
</html>