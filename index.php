<?php

$server="localhost";
$login="root";
$pass="";

try{
    $connexion=new PDO("mysql:host=$server;dbname=france;charest=utf8",$login,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connexion à la bdd france est reussi<br>";
    echo "affichage de tt la tables regions reussi<br>";
    echo "affichage de tt la tables deapartements pour ordre alphabétique  reussi<br>";
    echo "Afficher toutes les villes ayant comme département le 60 en ordonnant avec le code postal reussi <br>.";
    echo "Afficher les 3 premières villes ayant comme code postal '60400' et en ordonnant par ordre alphabétique.<br>";
    echo "Afficher toutes les villes contenant le mot 'saint'.";
    echo "Afficher le nombre de villes par département. (Le nom des départments doit apraitre)<br>";
    echo "Afficher les villes ayant comme région 'Picardie'<br>";
    echo "Afficher le nombre de villes par départment et par région. (Le nom des départments et des régions doivent aparaitre).";
     //exercice 1 afficher ts de la table regions
     echo "<h3 style='background-color:red;text-align:center;'>exercice 1</h3><br>";
     $requette3=$connexion->prepare("SELECT * FROM regions");
     $requette3->execute();
     $resultat3=$requette3->fetchAll();//on va stocker le résultat dans une variable pour l'afficher facilement,on utilise la méthode fetchAll pour l'affichage
     echo "<pre>";
     print_r($resultat3);
     echo "</pre>";
     //exercice 2 afficher ts de la table departements par ordre alphabitique
     echo "<h3 style='background-color:red;text-align:center;'>exercice 2</h3><br>";
     $requette=$connexion->prepare("SELECT * FROM  departements ORDER BY nom_dep");
     $requette->execute();
     $resultat=$requette->fetchAll();//on va stocker le résultat dans une variable pour l'afficher facilement,on utilise la méthode fetchAll pour l'affichage
     echo "<pre>";
     print_r($resultat);
     echo "</pre>";
    
     //exercice 3 Afficher toutes les villes ayant comme département le 60 en ordonnant avec le code postal.
     echo "<h3 style='background-color:red;text-align:center;'>exercice 3</h3><br>";
     $sql=$connexion->prepare("SELECT * FROM  villes WHERE dep=60 ORDER BY cp");

     $sql->execute();
     $sql=$sql->fetchAll();
     echo "<pre>";
     print_r($sql);
     echo "</pre>";

      //exercice 4 Afficher les 3 premières villes ayant comme code postal "60400" et en ordonnant par ordre alphabétique.
      echo "<h3 style='background-color:red;text-align:center;'>exercice 4</h3><br>";
      $sql1=$connexion->prepare("SELECT ville FROM  villes WHERE cp=60400 ORDER BY ville LIMIT 3");

     $sql1->execute();
     $sql1=$sql1->fetchAll();
     echo "<pre>";
     print_r($sql1);
     echo "</pre>";

     //exercice 5 Afficher toutes les villes contenant le mot "saint"..
     echo "<h3 style='background-color:red;text-align:center;'>exercice 5</h3><br>";
     $sql2=$connexion->prepare("SELECT ville FROM  villes  WHERE ville LIKE '%saint%'");

     $sql2->execute();
     $sql2=$sql2->fetchAll();
     echo "<pre>";
     print_r($sql2);
     echo "</pre>";

    //exercice 6 Afficher le nombre de villes par département. (Le nom des départments doit aparaitre)
        echo "<h3 style='background-color:red;text-align:center;'>exercice 6</h3><br>";

        $jointure_externe="SELECT departements.nom_dep,COUNT(villes.dep) AS nombre_de_villes_par_departement
        FROM villes 
        inner JOIN departements
        ON departements.dep = villes.dep
        GROUP BY departements.nom_dep
      ";

        $requette5=$connexion->prepare($jointure_externe);
        $requette5->execute();
        $resultat5=$requette5->fetchAll();
        echo "<pre>";
        print_r($resultat5);
        echo "</pre>";

        //exercice 7 Afficher les villes ayant comme région "Picardie"
        echo "<h3 style='background-color:red;text-align:center;'>exercice 7</h3><br>";
        $jointure_interne1="SELECT villes.ville,regions.nom_region
        FROM villes 
        inner JOIN regions
        ON villes.region = regions.region
        WHERE regions.nom_region='Picardie';
      ";

        $requette6=$connexion->prepare($jointure_interne1);
        $requette6->execute();
        $resultat6=$requette6->fetchAll();
        echo "<pre>";
        print_r($resultat6);
        echo "</pre>";

   

       /* exercice 8 Afficher le nombre de villes par départment et par région. (Le nom des départments et des régions doivent aparaitre).
       echo "<h3 style='background-color:red;text-align:center;'>exercice 8</h3><br>";
       $jointure_externe6="SELECT departements.nom_dep,regions.nom_region,COUNT(villes.dep) AS nombre_de_villes_par_departement,COUNT(villes.region)
       FROM villes
       INNER JOIN departements ON departements.dep = villes.dep
       INNER JOIN regions ON villes.region = regions.region
      
       GROUP BY departements.nom_dep,regions.nom_region
      
     ";

       $requette6=$connexion->prepare($jointure_externe6);
       $requette6->execute();
       $resultat6=$requette6->fetchAll();
       echo "<pre>";
       print_r($resultat6);
       echo "</pre>";
       echo "<h3 style='background-color:red;text-align:center;'>exercice 9</h3><br>";

      $operation="SELECT COUNT(villes.region)>1 FROM villes";
      $requette7=$connexion->prepare($operation);
      $requette7->execute();
      $resultat7=$requette7->fetchAll();
      echo "<pre>";
      print_r($resultat7);
      echo "</pre>";*/
}catch(PDOException $e){
    echo "erreur".$e->getMessage();
}
?>