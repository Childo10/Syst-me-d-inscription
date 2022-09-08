<?php
session_start();
$erreur=[];
$data=[];
$success="";

//Cette fonction permet de vérifier si une donnée existe et estnon vide.
//Elle retourne un booléen.

function verif_data($donnees): bool{
    return isset($donnees) AND !empty($donnees);
}

//Vérification de l'existence des données envoyées via le formulaire
if(verif_data($_POST['titre'])){
    $data['titre']=$_POST['titre'];
}
else {
    $erreur['titre']= '<p style="color:red;" >Titre invalide ou vide</p>';
    
}



if(verif_data($_POST['descri'])){
    $data['descri']=$_POST['descri'];
}
else{
    $erreur['descri']='<p style="color:red;" >Description invalide ou vide</p>';
}

//Traitement deu fichier envoyé 
if(isset($_FILES ['img']) AND $_FILES['img']['error']==0){
    if($_FILES['img']['size']<=3000000){
        $infofiles= pathinfo($_FILES['img']['name']);
        $extensions_upload= $infofiles['extension'];
        $extensions_autorisees= array('png','jpeg', 'jpg','gif');

        if(in_array($extensions_upload,$extensions_autorisees)){
            move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/' .
            basename($_FILES['img']['name']));
            $data['image']='uploads/' .
            basename($_FILES['img']['name']);
        }
        else{
            $erreur['image']="<p style='color:red;'Désole,l'extension du fichier n'est pas autorisée.</p>";
            echo $erreur['image'];
        }
    }
    else{
        $erreur['image']="<p style='color:red;'>Fichier trop volumineux.</p>";
        echo $erreur['image'];
    }
}
else{
    $erreur['image']="<p style='color:red;'>Désolé, une erreur s'est produite lors de l'envoi de l'image.</p>";
    echo $erreur['image'];
    
}
//Je vérifie si toutes les conditions sont remplies.
if(empty($erreur)){
    //Si conditions remplies, je me connecte à la base de données.
    try 
    {
        $bdd= new PDO('mysql:host=localhost; dbname=test','root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } 
    catch (Exception $e) 
    {
        die('Erreur= '. $e->getMessage());
    }
    //Je prépare ma requete d'enregistrement des données dans la base de données.
    $requete= $bdd->prepare('INSERT INTO article(Titre, Descrip, Img) VALUES(:Titre, :Descrip, :Img)');
    //J'execute la requete.
    $requete->execute(array(
        'Titre'=>$data['titre'],
        'Descrip'=>$data['descri'],
        'Img'=> $data['image']
    ));
    $requete->closeCursor();
    $success="<p style='color: white; background-color: blue;'>Votre article a été enregistré avec succès.</p>";
    header('location:Article.php?success= '. $success);
    
 }
 else{
    $_SESSION['erreur_art']= $erreur;
    header('location:Ajout_article.php');
 }





