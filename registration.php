<?php
    /* Homepage: registration.php */
    // database log in:
    $BDD = array();
    $BDD['host'] = "localhost";
    $BDD['user'] = "root1";
    $BDD['pass'] = "ROOT";
    $BDD['db'] = "test1";
    $mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);

    if(!$mysqli) {
        echo "Connexion failed";
        exit;
    }
        // automatic creation of the "members" table:
        echo mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS `".$BDD['db']."`.`members` ( `id` INT NOT NULL AUTO_INCREMENT , `firstname` VARCHAR(25) NOT NULL , `lastname` VARCHAR(25) NOT NULL , `mail` VARCHAR(25) NOT NULL, `confirm_mail` VARCHAR(25) NOT NULL, `ddn` DATE NOT NULL, `mdp` CHAR(32) NOT NULL ,`sex` CHAR(32) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM;")?"":"Error creating members table: ".mysqli_error($mysqli);
        
    // by default, we display the form


    // form processing:


    // $_post is used to retrieve the information submitted in the form from the database
    // isset checks that the variable exists
    // the user clicked on "Register", so we ask if the fields are defined with "isset"
    if(empty($_POST)){ 
    
    }elseif(empty($_POST['firstname'])){ // the firstname field is empty, we stop the execution of the script and display an error message
        echo "The First Name field is empty.";
        exit;
        
    }elseif(empty($_POST['lastname'])){
        echo "The Last Name field is empty.";
        exit;
    }elseif(empty($_POST['mail'])){
        echo "The Mobile Number or Email field is empty.";
        exit;
    }elseif(empty($_POST['confirm_mail'])){
        echo "The Confirm mobile number or email field is empty.";
        exit;
    }elseif(empty($_POST['mdp'])){
        echo "The New Password field is empty.";
        exit; 
    }elseif(empty($_POST['day'])){
        echo "The day of birth must be filled in.";
        exit; 
    }elseif(empty($_POST['month'])){
        echo "Month of birth must be filled in.";
        exit;
    }elseif(empty($_POST['year'])){
        echo "The year of birth must be filled in.";
        exit;
    } elseif(!preg_match("#^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#",$_POST['firstname'])){
        echo "The first name must be entered in lowercase letters without accents, without special characters.";
        exit;
    } elseif(!preg_match("#^[a-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+$#",$_POST['lastname'])){
        echo "The name must be entered in lowercase letters without accents, without special characters.";
        exit;
    } elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_POST['mail'])){
        echo "The email address must be entered in lowercase letters without accents, without special characters.";
        exit;
    } elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_POST['confirm_mail'])){
        echo "The confirmation email address must be entered in lowercase letters without accents, without special characters.";
        exit;
    } elseif(strlen($_POST['firstname'])>15){//le firstname est trop long, il dépasse 25 caractères
        echo "The number of characters in the first name is too long, it exceeds 15 characters.";
        exit;
    } elseif(strlen($_POST['lastname'])>15){//le firstname est trop long, il dépasse 25 caractères
        echo "The number of characters in the name is too long, it exceeds 15 characters.";
        exit;
    } elseif(strlen($_POST['mdp'])<7){
        echo "The number of characters in the password is too short, it must contain more than 7 characters.";
        exit;
    }elseif($_POST['mail']!= $_POST['confirm_mail']){
        echo "The confirmation email address is not the same as the initial email address";
        exit;
    } else {
        $result=mysqli_query($mysqli,"SELECT COUNT(*) AS nb FROM membres WHERE mail = '" . $_POST['mail'] . "'"); //nb = number
        $info = mysqli_fetch_array($result); // in order to retrieve the result
        if($info['nb']>0){
            echo "This email address is already in use";
            exit;  
        } else { // all the checks are done, we go to the recording in the database:
            $day = str_pad($_POST['day'], 2, '0', STR_PAD_LEFT);
            $month = str_pad($_POST['month'], 2, '0', STR_PAD_LEFT);
            $ddn=$_POST["year"]."-".$month."-".$day;
            if(!mysqli_query($mysqli,"INSERT INTO members SET firstname='".$_POST['firstname']."', lastname='".$_POST['lastname']."', mail='".$_POST['mail']."', confirm_mail='".$_POST['confirm_mail']."', ddn='".$ddn."' , sex='".$_POST['sex']."' ,mdp='".md5($_POST['mdp'])."'")){ //we encrypt the password with the function specific to PHP: md5()
                echo "An error occurred: ".mysqli_error($mysqli);
            } else {
                echo "You are registered successfully!";
                exit;
                // we no longer display the form
            }
        }
    }

    ?>
    
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <meta name="viewport" content="minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, width=device-width, shrink-to-fit=no"/>
    </head>
    <body>
        <form method="post" action="login.php">
            <!-- <div class="fb-header-base"></div> -->
            <div class="fb-header">
            
                <div id="form1">
                    <div class="flex">
                        <div style="margin-top:8px;">Email or Phone</div>
                        <input placeholder="Email" type="text" name="mail" id="email"/>
                    </div>
                </div>
                <div id="form2">
                    <div class="flex">
                        <div style="margin-top:8px;">Password</div>
                        <input placeholder="Password" type="password" name="mdp" id="password"/>
                        <div class="font-size">Forgot account informations ? </div>
                    </div>
                </div>
                <div id="form3">
                    <div class="flex" style="height:21px; margin-top:8px">
                        <!-- <div style="color:#3d5b99; margin-top:8px;">""</div> -->
                        <input type="submit" class="submit1" name="connexion" value="Log in" id="btnLogIn"> 
                    </div> 
                </div>
            </div>
        </form>
        <div id="missmailLog"> </div>
        <div id="misspassword"> </div>


        <form method="post" action="registration.php">
            <div class="fb-body">
                <div id="form4" >
                    <div> 
                        <div class="center-element">
                            <div id="intro2">Sign up</div> 
                            <div id="intro3">It's free (and always will be)</div>
                        </div>
                        <div class="replace" >
                            <input class="test" placeholder="First name" type="text" id="firstname" name="firstname"> 
                        </div>
                        <div id="missfirstname"> </div> 
                        

                        <div class="replace">
                            <input placeholder="Last name" type="text" id="lastname" name="lastname" >
                        </div>
                        <div id="missname"> </div> 
                        

                        <div class="replace">
                            <input placeholder="Email" id="mail" type="text" name="mail" >
                        </div>
                        <div id="missmail"></div>
                        
                        
                        <div class="replace">
                            <input placeholder="Confirm your email" type="text" id="confirm_mail" name="confirm_mail">
                        </div>
                        <div id="missconfirm_mail"></div>


                        <div class="replace">
                            <input placeholder="Password" type="password" id="mdp" name="mdp" >
                        </div>
                        <div id="missmdp"></div>


                        <div class="replace">
                            <p>Date of birth</p> 
                            <div class="container">
                                <select name="day" id="day" > 
                                    <option value="">Day</option>
                                    <?php 
                                    for($i=0;$i<31;$i++) 
                                    {
                                    ?>
                                    <option value="<?php echo $i+1;?>"> <?php echo $i+1; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <select name="month" id="month" >  
                                <option value="" >Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7" >July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <select name="year" id="year" ><br>
                                    <option value="">Year</option>
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
                        </div>
                        <div id="missdate"></div>
                            <br />
                            <div class="replace">        
                                <input type="radio" id="r-b" name="sex" value="female" checked> Woman
                                <input type="radio" id="r-b" name="sex" value="male" />Man
                            </div>
                        
                    </div>
                        <p id="intro4">By clicking on register, you accept our Conditions
                        and indicate that you have read our Data Use Policy, including our Use of Cookies.
                        You will be able to receive text notifications from Facebook and can unsubscribe at any time.
                        </p>
                    <div class="green-btn">
                        <input type="submit" id="btnregistration" class="button2" name="bouton" value="Sign up" />
                    </div>
                </div>
            </div>  
        </form>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>              
        <script src="form.js"></script>
    </body>
<html>


