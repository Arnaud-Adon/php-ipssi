
<!Doctype>
<html>
    <head>
        <title>S'inscrire</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <fieldset>
            <label>Formulaire d'inscription</label>
            <form action="#" method="post">
                <table>                              
                    <tr><th>Votre Login:</th><td><input type="text" name="login_register" width="100" size="40" placeholder="Entrer votre pseudo" value=""></td></tr><br>
                    <tr><th>Votre Mot de passe:</th><td><input type="password" name="password_register" size="40" placeholder="Entrer votre mot de passe" value=""></td></tr><br>
                    <tr><th></th><td><input type="submit" value="Enregistrer"></td></tr><br>                   
                </table>
            </form>
        </fieldset>
    </body>
</html>

<?php
    session_start();

    if(isset($_POST['login_register']) && isset($_POST['password_register'])){
        if($file=fopen('Register.csv', 'a+')){
            $login=array();
            while($result = fgetcsv($file,null,';')){
                $login[]=$result[0];
            }
            if(in_array($_POST['login_register'], $login)){
                echo 'Le login existe deja';
            }
            else{
                fputcsv($file, $_POST,';');
                //echo 'Bienvenue '.$_POST['login_register'];
                $_SESSION['login']=$_POST['login_register'];
                //$_SESSION['password']=$_POST['password_register'];
                header('Location:index.php');
            }
        }
        fclose($file);
    }
?>