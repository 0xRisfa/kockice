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

// Determine if there's a tie between the first and second players
$isTie = isset($results[1]) && $results[0]['score'] == $results[1]['score'];
?>
<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="resultstyles.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
</head>
    <title>Game Results</title>
</head>
<body>
    <header id="header">
        <h1>🎲Game Results🎲</h1>
    </header>
    <div class="podium-container">
        <?php if (isset($results[0])): ?>
            <div class="player-position first-place">
                <img src="http://193.2.139.22/dice/dice1.gif" alt="First Place">
                <p class="name" id="first-name"><?php echo $results[0]['user']['name']; ?></p>
                <p class="score" id="first-score">Score: <?php echo $results[0]['score']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($results[1])): ?>
            <div class="player-position second-place">
                <img src="http://193.2.139.22/dice/<?php echo $isTie ? 'dice1.gif' : 'dice2.gif'; ?>" alt="Second Place">
                <p class="name"><?php echo $results[1]['user']['name']; ?></p>
                <p class="score">Score: <?php echo $results[1]['score']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($results[2])): ?>
            <div class="player-position third-place">
                <img src="http://193.2.139.22/dice/dice3.gif" alt="Third Place">
                <p class="name"><?php echo $results[2]['user']['name']; ?></p>
                <p class="score">Score: <?php echo $results[2]['score']; ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="congratulations">
        <?php if ($isTie): ?>
            <p>🎉 Congratulations to both <?php echo $results[0]['user']['name']; ?> and <?php echo $results[1]['user']['name']; ?> for tying with the highest score of <?php echo $results[0]['score']; ?>! 🎉</p>
        <?php else: ?>
            <p>🎉 Congratulations to <?php echo $results[0]['user']['name']; ?> for winning with the highest score of <?php echo $results[0]['score']; ?>! 🎉</p>
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