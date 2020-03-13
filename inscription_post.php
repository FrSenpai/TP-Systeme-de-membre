<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=tp-membre;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


// Enchainer les if pour que ça fonctionn, faire attention à comment on appelle les variables.
// Faire une verification des mdp basiques.



$req_sql_pseudo_existant = 'SELECT COUNT(pseudo) AS nb_pseudo_existant FROM membres WHERE pseudo = \''.$_POST['pseudo'].'\'';



if (isset($_POST['pseudo']) && preg_match("#^[a-z0-9-_]+$#iU", $_POST['pseudo'])) {
    $req = $bdd->query($req_sql_pseudo_existant);
    $donnees = $req->fetch();
    if (!$donnees['nb_pseudo_existant'] >= 1) {
        $req->closeCursor();
        if (isset($_POST['pass']) && preg_match("#^[a-z0-9-_]+$#iU", $_POST['pass']) && $_POST['pass'] == $_POST['second_pass']) {
            if (isset($_POST['mail']) && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['mail'])) {
                $pseudo = $_POST['pseudo'];
                $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $email = $_POST['mail'];
                $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, id_groupe, email, date_inscription) VALUES(:pseudo, :pass, :id_groupe, :email,  CURDATE())');
                $req->execute(array(
                    'pseudo' => $pseudo,
                    'pass' => $pass_hache,
                    'id_groupe' => '1',
                    'email' => $email
                    ));
                    echo nl2br('Votre inscription a bien été prise en compte !
        Voudriez vous'  
        );
        ?> <a href="index.php"> revenir à l'accueil ?</a> <?php
            } else {
                echo nl2br('Votre email nous semble suspicieux, mettez-en un autre !
        Voudriez vous'  
        );
        ?> <a href="index.php"> revenir à l'accueil ?</a> <?php
            }
        } else {
            echo nl2br('Vos mots de passes ne correspondent pas / contiennent un caractère interdit !
        Voudriez vous'  
        );
        ?> <a href="index.php"> revenir à l'accueil ?</a> <?php
        }
    } else {
        echo nl2br('Ce pseudo est déjà utilisé !
        Voudriez vous'  
        );
        ?> <a href="index.php"> revenir à l'accueil ?</a> <?php
    }
    
} else {
    echo "Erreur ligne 21";
}

?>