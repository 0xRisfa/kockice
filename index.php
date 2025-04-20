<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['startGame'])) {
    // Store user data in session
    $_SESSION['users'] = [
        ['name' => $_POST['name1']],
        ['name' => $_POST['name2']],
        ['name' => $_POST['name3']]
    ];
    $_SESSION['diceCount'] = $_POST['diceCount'];
    $_SESSION['rounds'] = $_POST['rounds'];

    // Redirect to the game page
    header("Location: game.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kockice</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="startstyles.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
</head>
<body>
    <header id="header">
        <h1>🎲Kockice🎲</h1>
    </header>
        <form method="post" action="">
        <div class="form-container">
            <div class="player-card">
                <h2>Player One</h2>
                <input type="text" name="name1" placeholder="Enter Player Name" required>
            </div>
            <div class="player-card">
                <h2>Player Two</h2>
                <input type="text" name="name2" placeholder="Enter Player Name" required>
            </div>
            <div class="player-card">
                <h2>Player Three</h2>
                <input type="text" name="name3" placeholder="Enter Player Name" required>
            </div>
        </div>
        <div class="options-container">
            <div class="options-card">
                <h2>Dice</h2>
                <select name="diceCount" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3" selected>3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="options-card">
                <h2>Turns</h2>
                <select name="rounds" required>
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <input type="submit" name="startGame" value="ROLL THE DICE" class="start-button">
    </form>
</body>
</html>