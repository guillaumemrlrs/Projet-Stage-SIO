<?php

// script d'upload pour l'attestation de stage.

require "inc.connexion.php"; 

if ( isset ($_POST['submit'])) {

$idEtudiant = $_POST['idEtu'];

}else { 
    header('Location: gestionEleves.php');
}
$j = 0; //Variable de l'index de l'image
$date = date("d-m-Y");
    

   for ($i = 0; $i < count($_FILES['attestStage']['name']); $i++) {//Boucle pour avoir chaque élement de l'array

        $target_path = "img/attestation/".$idEtudiant."/attest".$i; // Declaration du chemain de l'upload
        $validextensions = array("jpeg", "jpg", "png","pdf");  //Extensions accptées
        $ext = explode('.', basename($_FILES['attestStage']['name'][$i]));//explode le fichier a partir du (.)
        $file_extension = end($ext); //Store l'extension dans une variable
        $target_path = $target_path ."-".$date.".".$file_extension;//set le chemin avec un nouveau nom de fichier
        $j = $j + 1;//Incremente le nombre de fichier uploader selon le fichier dans l'array  

        if (($_FILES["attestStage"]["size"][$i] < 1000000) //Approx. 1000kb peuvent être upload
               && in_array($file_extension, $validextensions)) {
           if (move_uploaded_file($_FILES['attestStage']['tmp_name'][$i], $target_path)) {//verifie que les fichier on bien été transferer
               echo $j. ').<span id="noerror">Fichier upload !</span><br/><br/>';
           } else {//Si les fichier n'on pas été déplacés
               echo $j. ').<span id="error">Erreur de transfert, Veuillez réessayer.</span><br/><br/>';
           }
        } else {//Si la taille des fichiers et/ou le type sont incorrect 
           echo $j. ').<span id="error">***Taille ou type de fichier incorrect***</span><br/><br/>';
       }
   }

?>



    
    