<?php
session_start();
//Cette fonction permet de vérifier si une information existe et est non vide.
//Elle retourne un booléen
function verifier_info($info): bool{
    return(isset($info) AND !empty($info));
}

//Je vérifie si les informations envoyés par le visiteur sont corrrects.
$erreur_nom = " ";
$erreur_prenom = " ";
$erreur_sexe = " ";
$erreur_age = " ";
$erreur_email = " ";
$erreur_mdp = " ";
$success= " ";

if (verifier_info($_POST['nom'])){
    $nom=$_POST['nom'];
}
else{
        $erreur_nom = '<p style="color:red;" class="alert-danger lead"> Nom invalide ou vide, veuillez réessayer! </p>';
}

if(verifier_info($_POST['prenom'])){
    $prenom=$_POST['prenom'];
}
else{
        $erreur_prenom = '<p style="color:red;" class="alert-danger lead"> Prénom invalide ou vide , veuillez réesayer!</p>';
}

if (verifier_info($_POST['sexe'])){
    $sexe=$_POST['sexe'];
}
else{
        $erreur_sexe = '<p style="color:red;" class="alert-danger lead"> sexe invalide ou vide,veuillez reéssayer!</p>';
}

if (verifier_info($_POST['email'])){
    $email=$_POST['email'];
}
else{
        $erreur_email = '<p style="color:red;" class="alert-danger lead"> Email invalide ou vide, veuillez reéssayer! </p>';
}

if (verifier_info($_POST['age'])){
    if($_POST['age'] > 0 AND $_POST['age']< 300){
        $age=$_POST['age'];
    }
    else{
        $_SESSION['erreur_age'] ='<p style="color:red;" class="alert-danger lead"> Inccorect, veuillez entrez une age valide!</p>';
    }

    }
   

else{
        $erreur_age = '<p style="color:red;" class="alert-danger lead"> Age invalide ou vide , veuillez reéssayer!</p>';
}

if (verifier_info($_POST['mdp'])){
    $mdp= password_hash($_POST['mdp'], PASSWORD_DEFAULT);
}
else{
        $erreur_mdp = '<p style="color:red;"class="alert-danger lead"> Mot de passe invalide ou vide, veuillez reéssayer! </p>';
}

//Je vérifie siles informations entrés par léutilisateur sont corrects
if(verifier_info($_POST['nom']) AND verifier_info($_POST['prenom'])AND verifier_info($_POST['sexe']) AND verifier_info($_POST['age']) AND verifier_info($_POST['email']) AND verifier_info($_POST['mdp'])){
    $success= '<p style="color:blue; font-size: 30px;" class="alert-primary lead">Inscription réussie! </p>';

//Si informations correct je me connecte a la base de données
    try
    {
        $bdd= new PDO ('mysql:host=localhost; dbname=test', 'root','', array (PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    //Récupération des informations saisies par l'utilisateur dans la base de données
    $req=$bdd->prepare('INSERT INTO utilisateur(Nom, Prenom, Sexe, Age, Email, Mot_de_passe) VALUES(:nom, :prenom, :sexe, :age, :email, :mdp)');
    $req->execute(array(
        'nom'=>$nom,
        'prenom'=>$prenom,
        'sexe'=>$sexe,
        'age'=>$age,
        'email'=>$email,
        'mdp'=>$mdp
    ));
    header('location:Inscription.php? success= '. $success);


}
//Si les informations de l'utilisateur sont incorrects, je le redirige vers la page d'inscription avec des messages d'erreurs 
else{
    $_SESSION['email']= $erreur_email;
    $_SESSION['sexe']= $erreur_sexe;
    header('location:Inscription.php?erreur-nom= '. $erreur_nom.'&erreur-prenom= '. $erreur_prenom. '&erreur-age= '. $erreur_age. '&erreur_email = '. $erreur_email. '&erreur-mdp= '. $erreur_mdp);
}
    
     
   



   

