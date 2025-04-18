<?php
session_start();

if (!isset($_SESSION['results'])) {
    // Redirect back to the index page if no results are set
    header("Location: index.php");
    exit();
}

$results = $_SESSION['results'];

// Sort players by score in descending order
usort($results, function ($a, $b) {
    return $b['score'] - $a['score'];
});

// Determine the winner(s)
$maxScore = $results[0]['score'];
$winners = array_filter($results, function ($result) use ($maxScore) {
    return $result['score'] == $maxScore;
});
?>
<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Game Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b2b2b;
            color: #f5f5f5;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #ffd700;
            margin-top: 20px;
        }

        .pedestal-container {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 20px;
            margin-top: 50px;
        }

        .pedestal {
            background-color: #333333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            text-align: center;
            color: #f5f5f5;
        }

        .pedestal.winner {
            background-color: #ffd700;
            color: #333333;
            font-weight: bold;
        }

        .pedestal.second {
            height: 150px;
        }

        .pedestal.first {
            height: 200px;
        }

        .pedestal.third {
            height: 100px;
        }

        .pedestal img {
            width: 50px;
            height: 50px;
            margin: 5px;
        }

        .new-game-button {
            background-color: #ff4500;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        .new-game-button:hover {
            background-color: #e63900;
        }
    </style>
</head>
<body>
    <h1>Game Results</h1>
    <div class="pedestal-container">
        <?php if (isset($results[1])): ?>
            <div class="pedestal second">
                <h2>2nd Place</h2>
                <p><?php echo $results[1]['user']['name']; ?></p>
                <p>Score: <?php echo $results[1]['score']; ?></p>
                <div>
                    <?php foreach ($results[1]['dice'] as $roll): ?>
                        <img src="http://193.2.139.22/dice/dice<?php echo $roll; ?>.gif" alt="Dice <?php echo $roll; ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($results[0])): ?>
            <div class="pedestal winner first">
                <h2>1st Place</h2>
                <p><?php echo $results[0]['user']['name']; ?></p>
                <p>Score: <?php echo $results[0]['score']; ?></p>
                <div>
                    <?php foreach ($results[0]['dice'] as $roll): ?>
                        <img src="http://193.2.139.22/dice/dice<?php echo $roll; ?>.gif" alt="Dice <?php echo $roll; ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (isset($results[2])): ?>
            <div class="pedestal third">
                <h2>3rd Place</h2>
                <p><?php echo $results[2]['user']['name']; ?></p>
                <p>Score: <?php echo $results[2]['score']; ?></p>
                <div>
                    <?php foreach ($results[2]['dice'] as $roll): ?>
                        <img src="http://193.2.139.22/dice/dice<?php echo $roll; ?>.gif" alt="Dice <?php echo $roll; ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php" method="POST">
        <input type="submit" class="new-game-button" name="newPlayers" value="New Game">
    </form>
</body>
</html>
<?php
// Clear session data
session_destroy();
?>