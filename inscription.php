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
    <h1>Inscrivez-vous vite !</h1></br>
    <!-- Formulaire d'inscription -->
    <form action="inscription_post.php" method="post">
        <label for="pseudo">Votre pseudo :</label></br>
        <input type="text" name="pseudo" /></br>
        <label for="pass">Votre mot de passe :</label></br>
        <input type="password" name="pass" /></br>
        <label for="second_pass">Répétez votre mot de passe :</label></br>
        <input type="password" name="second_pass" /></br>
        <label for="mail">Votre adresse mail :</label>
        <input type="email" name="mail" />
        <input type="submit" />
    </form>
    


</body>

</html>