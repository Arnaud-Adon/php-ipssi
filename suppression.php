<?php


if(isset($_GET['login'])){
    if($file= fopen('Register.csv', 'w+')){
        $login=array();
        $password=array();
        while($result= fgetcsv($file)){
            $login[]=$result[0];
            $password[]=$result[1];
            if($_GET['login'] == $login[]){
                unset($login[]);unset($password[]);
                fputcsv($file, array($login,$password),';');
                fclose($file);
                header('Location:index.php');
            }
            
        }
    }
}