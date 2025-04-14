<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['startGame'])) {
    // Store user data in session
    $_SESSION['users'] = [
        ['name' => $_POST['name1'], 'surname' => $_POST['surname1'], 'address' => $_POST['address1']],
        ['name' => $_POST['name2'], 'surname' => $_POST['surname2'], 'address' => $_POST['address2']],
        ['name' => $_POST['name3'], 'surname' => $_POST['surname3'], 'address' => $_POST['address3']]
    ];

    // Redirect to the game page
    header("Location: game.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dice Game</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
    <h1>Enter Player Details</h1>
    <form method="post" action="">
        <h2>Player 1</h2>
        Name: <input type="text" name="name1" required><br>
        Surname: <input type="text" name="surname1" required><br>
        Address: <input type="text" name="address1" required><br>

        <h2>Player 2</h2>
        Name: <input type="text" name="name2" required><br>
        Surname: <input type="text" name="surname2" required><br>
        Address: <input type="text" name="address2" required><br>

        <h2>Player 3</h2>
        Name: <input type="text" name="name3" required><br>
        Surname: <input type="text" name="surname3" required><br>
        Address: <input type="text" name="address3" required><br>

        <input type="submit" name="startGame" value="Start Game">
    </form>
</body>
</html>