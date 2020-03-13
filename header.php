<?php session_start(); ?>
<h1>Site d'apprentissage concernant l'espace membre</h1>
<ul>
    <li><a href="index.php">Revenir à l'accueil</a></li>

    <?php 
        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            ?>
            <li><a href="profil.php">Mon profil</a></li>
            <li><a href="deconnection.php">Déconnexion</a></li>
            <?php
        } else {
            ?>
            <li><a href="connexion.php">Se connecter</a></li>
        <li><a href="inscription.php">S'inscrire</a></li>
        <?php
        }
        ?>
        
    
    
    
</ul>