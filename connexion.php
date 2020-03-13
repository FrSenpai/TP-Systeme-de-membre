<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<?php 
    include 'header.php';  
?>

    <h1>Déjà un compte ? Connectez-vous !</h1></br>
    <!-- Formulaire d'inscription -->
    <form action="connexion_post.php" method="post">
        <label for="pseudo">Votre pseudo :</label></br>
        <input type="text" name="pseudo" /></br>
        <label for="pass">Votre mot de passe :</label></br>
        <input type="password" name="pass" /></br>
        <input type="checkbox">Connexion automatique ?</button></br>
        <input type="submit" />
    </form>


</body>

</html>