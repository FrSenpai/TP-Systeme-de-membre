<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=tp-membre;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req_sql_contenant_pseudo = 'SELECT pseudo AS pseudo_bdd FROM membres WHERE pseudo=\''.$_POST['pseudo'].'\'';


if (isset($_POST['pseudo'])) {
    $req = $bdd->query($req_sql_contenant_pseudo);
    $donnees = $req->fetch();
    if ($_POST['pseudo'] == $donnees['pseudo_bdd']) {
        echo "Ok !";
        $req->closeCursor();
        if (isset($_POST['pass'])) {
            $mdp_utilisateur = htmlspecialchars($_POST['pass']); 
            $req = $bdd->query('SELECT pass AS mdp_hash FROM membres WHERE pseudo=\''.$_POST['pseudo'].'\'');
            $donnees = $req->fetch();
            if (password_verify($mdp_utilisateur, $donnees['mdp_hash'])) {
                $req->closeCursor();
                $req = $bdd->query('SELECT id FROM membres WHERE pseudo=\''.$_POST['pseudo'].'\'');
                $donnees = $req->fetch();
                $_SESSION['id'] = $donnees['id'];
                $_SESSION['pseudo'] = $_POST['pseudo'];
                echo nl2br('Vous êtes authentifié !
                    Voudriez vous ' );
        ?> <a href="index.php"> revenir à l'accueil ?</a> <?php
                $req->closeCursor();
                
                if (isset($_POST['checkbox'])) {
                    // Si checkbox coché, on enregitre les données en cookie.
                    setcookie('login', $_POST['pseudo']);
                    $req = $bdd->query('SELECT pass AS mdp_hash FROM membres WHERE pseudo=\''.$_POST['pseudo'].'\'');
                    $donnees = $req->fetch();

                    setcookie('pass_hache', $donnees['mdp_hash']);
                    $req->closeCursor();
                }
            } else {
                $req->closeCursor();
                echo "Le mot de passe est incorrect";
            }
        } else {
            echo "Le champ du mot de passe est vide";
        }
    } else {
        echo "Le pseudo ne correspond à aucun en BDD";
        $req->closeCursor();
    }
} else {
    echo "Le champ du pseudo est vide.";
}

/* Corrigé du TP (beaucoup plus rapide que moi è_è)


//  Récupération de l'utilisateur et de son pass hashé
$req = $bdd->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $pseudo));
$resultat = $req->fetch();

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}
*/
?>

