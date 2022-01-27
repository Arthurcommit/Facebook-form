<?php
/* Homepage: login.php */
session_start(); 
if(isset($_POST['connexion'])) { // if the button "login" is clicked
    if(empty($_POST['mail'])) { // 'empty' check if the field is empty and if it exists (isset)
        echo "Le champ mail est vide."; // we check that the "mail" field is not empty
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide
        if(empty($_POST['mdp'])) {
            echo "Password field is empty.";
        } else {

            // $_post permet de récuperer dans la database les infos soumises dans le formulaire
            $mail = $_POST["mail"]; 
            $MotDePasse = $_POST["mdp"]; 
           

            //on se connecte à la base de données:
            $BDD = array();
            $BDD['host'] = "localhost";
            $BDD['user'] = "root";
            $BDD['pass'] = "ROOT";
            $BDD['db'] = "test1"; // name_of_the_database in phpMyAdmin
            $mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
            // we check that the login is done correctly:
            if(!$mysqli){
            "Failed to login to database.";
            } else {
                // we now execute the query in the database to find if this data exists and matches:
                $Query = mysqli_query($mysqli,"SELECT * FROM members WHERE mail = '".$mail."' AND mdp = '".md5($MotDePasse)."'");
                // if mysqli_num_rows() returns 0, it found no results
                // mysqli_num_rows() checks the query in BDD
                if(mysqli_num_rows($Query) == 0) {
                    echo "The email or password is incorrect, the account was not found.";
                } else {
                    // we open the session with $_SESSION:
                    $_SESSION['mail'] = $mail; // the session can be called differently and its content can also be something other than the email
                    echo "You are now logged in!";
                }
            }
        }
    }
}
?>
