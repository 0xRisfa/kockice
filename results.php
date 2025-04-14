<?php
session_start();

if (!isset($_SESSION['results'])) {
    // Redirect back to the index page if no results are set
    header("Location: index.php");
    exit();
}

$results = $_SESSION['results'];

// Determine the winner(s)
$maxScore = max(array_column($results, 'score'));
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
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="title"><h1>Gambling Room</h1></div>
            <div class="clear"></div>
        </div>
        <div id="main">
            <h1>Game Results</h1>
            <?php foreach ($results as $result): ?>
                <h2><?php echo "{$result['user']['name']} {$result['user']['surname']} ({$result['user']['address']})"; ?></h2>
                <p>Dice Rolls: 
                    <?php foreach ($result['dice'] as $roll): ?>
                        <img src="http://193.2.139.22/dice/<?php echo $roll; ?>.png" alt="Dice <?php echo $roll; ?>" style="width: 50px; height: 50px;">
                    <?php endforeach; ?>
                </p>
                <p>Total Score: <?php echo $result['score']; ?></p>
            <?php endforeach; ?>

            <h2>Winner(s):</h2>
            <?php foreach ($winners as $winner): ?>
                <p><?php echo "{$winner['user']['name']} {$winner['user']['surname']} with a score of {$winner['score']}"; ?></p>
            <?php endforeach; ?>

            <form action="index.php" method="POST">
                <center><input type="submit" style="margin: 10px 0 0 0; width: 350px;" name="newPlayers" value="New Game"></center>
            </form>
        </div>
    </div>

    <script>
        // Redirect back to the form after 10 seconds
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 10000);
    </script>
</body>
</html>
<?php
// Clear session data
session_destroy();
?>