<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h1>Se connecter</h1>
<form action="" method="post">
    <div>
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" placeholder="john77@gmail.com">
    </div>
    <div>
        <label for="mdp">Password *</label>
        <input type="password" id="mdp" name="mdp">
    </div>
    <button type="submit" class="btn btn-outline-danger">Valider</button>
</form>
</body>
</html>
