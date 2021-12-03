<?php
    
    /* page: inscription.php */
//connexion à la base de données:
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "ROOT";
$BDD['db'] = "test1";
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);

if(!$mysqli) {
    echo "Connexion non établie.";
    exit;
}
    //création automatique de la table "membres":
    echo mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS `".$BDD['db']."`.`membres` ( `id` INT NOT NULL AUTO_INCREMENT , `firstname` VARCHAR(25) NOT NULL , `lastname` VARCHAR(25) NOT NULL , `mail` VARCHAR(25) NOT NULL, `confirm_mail` VARCHAR(25) NOT NULL, `ddn` DATE NOT NULL, `mdp` CHAR(32) NOT NULL ,`sex` CHAR(32) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM;")?"":"Erreur création table membres: ".mysqli_error($mysqli);
    
//par défaut, on affiche le formulaire 


//traitement du formulaire:


    // $_post permet de récuperer dans la database les infos soumises dans le formulaire
    // isset vérifie que la variable existe 
    // l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont définis avec "isset"
    if(empty($_POST)){ 
    
    }elseif(empty($_POST['firstname'])){ //le champ firstname est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ Prénom est vide.";
        exit;
        
    }elseif(empty($_POST['lastname'])){
        echo "Le champ Nom de famille est vide.";
        exit;
    }elseif(empty($_POST['mail'])){
        echo "Le champ Numéro de mobile ou email est vide.";
        exit;
    }elseif(empty($_POST['confirm_mail'])){
        echo "Le champ Confirmer numéro de mobile ou email est vide.";
        exit;
    }elseif(empty($_POST['mdp'])){
        echo "Le champ Nouveau mot de passe est vide.";
        exit; 
    }elseif(empty($_POST['jour'])){
        echo "Le jour de naissance doit être renseigné.";
        exit; 
    }elseif(empty($_POST['mois'])){
        echo "Le mois de naissance doit être renseigné.";
        exit;
    }elseif(empty($_POST['annee'])){
        echo "L'année de naissance doit être renseignée.";
        exit;
    } elseif(!preg_match("#^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#",$_POST['firstname'])){
        echo "Le prénom doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
        exit;
    } elseif(!preg_match("#^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#",$_POST['lastname'])){
        echo "Le nom doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
        exit;
    } elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_POST['mail'])){
        echo "L'adresse mail doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
        exit;
    } elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_POST['confirm_mail'])){
        echo "L'adresse mail de confirmation doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
        exit;
    } elseif(strlen($_POST['firstname'])>15){//le firstname est trop long, il dépasse 25 caractères
        echo "Le nombre de caractères du prénom est trop long, il dépasse 15 caractères.";
        exit;
    } elseif(strlen($_POST['lastname'])>15){//le firstname est trop long, il dépasse 25 caractères
        echo "Le nombre de caractères du nom est trop long, il dépasse 15 caractères.";
        exit;
    } elseif(strlen($_POST['mdp'])<7){
        echo "Le nombre de caractères du mot de passe est trop court, il doit contenir plus de 7 caractères.";
        exit;
    }elseif($_POST['mail']!= $_POST['confirm_mail']){
        echo "L'adresse mail de confirmation n'est pas identique à l'adresse mail initiale";
        exit;
    } else {
        $result=mysqli_query($mysqli,"SELECT COUNT(*) AS nb FROM membres WHERE mail = '" . $_POST['mail'] . "'"); //nb = nombre
        $info = mysqli_fetch_array($result); //permet de recupérer le résultat
        if($info['nb']>0){
            echo "Cette adresse mail est déja utilisée";
            exit;  
        } else { //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
            $jour = str_pad($_POST['jour'], 2, '0', STR_PAD_LEFT);
            $mois = str_pad($_POST['mois'], 2, '0', STR_PAD_LEFT);
            $ddn=$_POST["annee"]."-".$mois."-".$jour;
            if(!mysqli_query($mysqli,"INSERT INTO membres SET firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', mail='".$_POST['mail']."', confirm_mail='".$_POST['confirm_mail']."', ddn='".$ddn."' , sex='".$_POST['sex']."' ,mdp='".md5($_POST['mdp'])."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
                echo "Une erreur s'est produite: ".mysqli_error($mysqli);
            } else {
                echo "Vous êtes inscrit avec succès!";
                exit;
                //on affiche plus le formulaire
            }
        }
    }

    ?>
    
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <script src="test.js"></script>
        <meta name="viewport" content="minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, width=device-width, shrink-to-fit=no"/>
    </head>
    <body>
        <form action="connexion.php" method="post">
            <!-- <div class="fb-header-base"></div> -->
            <div class="fb-header">
            
                <div id="form1">
                    <div class="flex">
                        <div style="margin-top:8px;">Email or Phone</div>
                        <input placeholder="Email" type="text" name="mail" value=""/>
                    </div>
                </div>
                <div id="form2">
                    <div class="flex">
                        <div style="margin-top:8px;">Password</div>
                        <input placeholder="Password" type="password" name="mdp"/>
                        <div class="font-size">Informations de compte oubliées ? </div>
                    </div>
                </div>
                <div id="form3">
                    <div class="flex" style="height:21px; margin-top:8px">
                        <!-- <div style="color:#3d5b99; margin-top:8px;">""</div> -->
                        <input type="submit" class="submit1" name="connexion" value="Connexion"> 
                    </div> 
                </div>
            </div>
        </form>
    


        <form method="post" action="inscription.php">
            <div class="fb-body">
                <div id="form4" >
                    <div> 
                        <div class="center-element">
                            <div id="intro2">Inscription</div> 
                            <div id="intro3" >C'est gratuit (et ça le restera toujours)</div>
                        </div>
                        <div class="replace">
                                <input placeholder="Prénom" type="text" id="firstname" name="firstname" ><div id="missprenom"> </div> 
                                <input placeholder="Nom de famille" type="text" id="lastname" name="lastname" ><div id="missnom"> </div> 
                                <input placeholder="Email" id="mail" type="text" name="mail" ><div id="missmail"></div>
                                <input placeholder="Confirmer votre email" type="text" id="confirm_mail" name="confirm_mail"><div id="missconfirm_mail"></div>
                                <input placeholder="Nouveau mot de passe" type="password" id="mdp" name="mdp" ><div id="missmdp"></div>
                                <p>Date de naissance</p> 
                            <div>
                                <select name="jour" id="day" > 
                                    <option value="">Jour</option>
                                    <?php 
                                    for($i=0;$i<31;$i++) 
                                    {
                                    ?>
                                    <option value="<?php echo $i+1;?>"> <?php echo $i+1; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <select name="mois" id="month" >  
                                    <option value="" >Mois</option>
                                    <option value="1">Janvier</option>
                                    <option value="2">Février</option>
                                    <option value="3">Mars</option>
                                    <option value="4">Avril</option>
                                    <option value="5">Mai</option>
                                    <option value="6">Juin</option>
                                    <option value="7" >Juillet</option>
                                    <option value="8">Aout</option>
                                    <option value="9">Septembre</option>
                                    <option value="10">Octobre</option>  
                                    <option value="11">Novembre</option> 
                                    <option value="12">Décembre</option>
                                </select>
                                <select name="annee" id="year" ><br>
                                    <option value="">Année</option>
                                    <?php
                                    for($i=1899;$i<2021;$i++)
                                    {
                                        ?>
                                        <option value="<?php echo $i+1;?>"> <?php echo $i+1; ?> </option>
                                        <?php
                                    }
                                    ?> 
                                </select>
                            </div> 
                            <div id="missdate"></div>
                            <br />
                            <div>        
                                <input type="radio" id="r-b" name="sex" value="female" checked> Femme
                                <input type="radio" id="r-b" name="sex" value="male" />Homme
                            </div>
                        </div>
                    </div>
                        <p id="intro4">En cliquant sur inscription, vous acceptez nos Conditions 
                        et indiquez que vous avez lu notre Politique d'utilisation des données, y compris notre Utilisation des Cookies.
                        Vous pourrez recevoir des notifications par texto de la part de Facebook et pouvez vous désabonner à tout moment.
                        </p>
                    <div class="green-btn">
                        <input type="submit" id="btninscription" class="button2" name="bouton" value="Inscription" />
                    </div>
                </div>
            </div>  
        </form>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>              
 <script src="formulaire.js"></script>
    </body>
<html>


