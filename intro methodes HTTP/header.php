<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *, ::before, ::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            height:40px;
            display:flex;
            justify-content:center;
            align-items: center;

        }

        .navbar a {
            color: #f2f2f2;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
    
<div class="navbar">
    <a href="index.php">Accueil</a>
    <a href="apropos.php">A propos</a>
    <?php if(!isset($_SESSION)) :?>
    <a href="inscription.php">Inscription</a>
    <?php else :?>
    <a href="deconnexion.php">Déconnexion</a>
    <?php endif;?>
</div>