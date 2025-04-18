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
    <title>Online Dice Game</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b2b2b;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #ff4500;
            margin: 20px 0;
            font-size: 36px;
        }

        .form-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .player-card {
            background-color: #333333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            text-align: center;
            width: 200px;
        }

        .player-card h2 {
            color: #ff4500;
            margin-bottom: 10px;
        }

        .player-card input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #222222;
            color: #f5f5f5;
            font-size: 16px;
        }

        .options-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .options-card {
            background-color: #333333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            text-align: center;
            width: 200px;
        }

        .options-card select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #222222;
            color: #f5f5f5;
            font-size: 16px;
        }

        .start-button {
            background-color: #ff4500;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .start-button:hover {
            background-color: #e63900;
        }
    </style>
</head>
<body>
    <h1>Online Dice</h1>
    <form method="post" action="">
        <div class="form-container">
            <div class="player-card">
                <h2>First Player</h2>
                <input type="text" name="name1" placeholder="Enter Player Name" required>
            </div>
            <div class="player-card">
                <h2>Second Player</h2>
                <input type="text" name="name2" placeholder="Enter Player Name" required>
            </div>
            <div class="player-card">
                <h2>Third Player</h2>
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