<?php
session_start();
?>
<!Doctype>
<html>
    <head>
        <title>TP Connexion</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <?php if (isset($_SESSION['login'])) { ?> 
            <h2>Bienvenue <?php echo $_SESSION['login'] ?></h2>
            <a href="deconnexion.php?deco=1">Se déconnecter</a>

            <h2>Liste des utilisateurs</h2>
            <table border="2">
                <thead><tr><th>Utilisateurs inscrits</th></tr></thead>
                <tbody>
                    <?php
                    if ($file = fopen('Register.csv', 'r')) {
                        $login = array();
                        while ($result = fgetcsv($file, null, ';')) {
                            $login[] = $result[0];
                        }
                        fclose($file);
                        foreach ($login as $pseudo) {
                            echo '<tr><td>' . $pseudo . '</td><td><a href="modification.php?login='.$pseudo.'">Modifier</a></td><td><a href="suppression.php?login='.$pseudo.'">supprimer</a></td></tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
    <?php
} else {
    ?>
            <fieldset>
                <label>Veuillez vous connecter</label>
                <form action="#" method="post">
                    <table>                              
                        <tr><th><label for="login">Login:</label></th><td><input id="login" type="text" name="login" width="100" size="40" placeholder="Entrer votre pseudo" value=""></td></tr><br>
                        <tr><th><label for="password">Mot de passe:</label></th><td><input id="password" type="password" name="password" size="40" placeholder="Entrer votre mot de passe" value=""></td></tr><br>
                        <tr><th></th><td><input type="submit" value="Validez"></td></tr><br>
                        <tr><td><a href="inscription.php">S'inscrire</a></td></tr>
                    </table>
                </form>
            </fieldset>
    <?php
}

if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($file = fopen('Register.csv', 'r')) {
        $login = array();
        $password = array();
        while ($result = fgetcsv($file, null, ';')) {            
            $login[] = $result[0];
            $password[] = $result[1];
        }
        if (in_array($_POST['login'], $login)) {
            if (in_array($_POST['password'], $password)) {
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
            }          
        }
        else{
            echo "Votre login ou votre mot de passe est incorrect";
        }
    }
    fclose($file);
}
?>      
    </body>
</html>
