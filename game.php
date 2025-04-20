<?php
session_start();

if (!isset($_SESSION['users'])) {
    // Redirect back to the index page if no users are set
    header("Location: index.php");
    exit();
}

// Initialize results
$results = [];
foreach ($_SESSION['users'] as $user) {
    $results[] = ['user' => $user, 'dice' => [], 'score' => 0, 'rollsLeft' => $_SESSION['rounds']]; // Initialize with 0
}

// Store results in session
$_SESSION['results'] = $results;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Dice Game</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="gamestyles.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <h1>Online Dice</h1>
    <div class="dice-area" id="diceArea">
        <!-- Dice will be dynamically updated here -->
    </div>
    <div class="players-container">
        <?php foreach ($_SESSION['users'] as $index => $user): ?>
            <div class="player-card" id="player-<?php echo $index; ?>">
                <h2><?php echo $user['name']; ?></h2>
                <p>Rolls Left: <span id="rollsLeft-<?php echo $index; ?>"><?php echo $_SESSION['rounds']; ?></span></p>
                <p>Dice Sum: <span id="score-<?php echo $index; ?>">0</span></p>
                <button onclick="rollDice(<?php echo $index; ?>)" id="rollButton-<?php echo $index; ?>">Roll the Dice</button>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        const diceImages = [
            'http://193.2.139.22/dice/dice1.gif',
            'http://193.2.139.22/dice/dice2.gif',
            'http://193.2.139.22/dice/dice3.gif',
            'http://193.2.139.22/dice/dice4.gif',
            'http://193.2.139.22/dice/dice5.gif',
            'http://193.2.139.22/dice/dice6.gif'
        ];

        let results = <?php echo json_encode($results); ?>;
        let isRolling = false; // Global flag to track if rolling is in progress

        function rollDice(playerIndex) {
            if (isRolling) {
                alert("Another player is rolling. Please wait.");
                return;
            }

            isRolling = true; // Set the flag to true
            const playerCard = document.getElementById(`player-${playerIndex}`);
            const rollsLeftElement = document.getElementById(`rollsLeft-${playerIndex}`);
            const scoreElement = document.getElementById(`score-${playerIndex}`);
            const rollButton = document.getElementById(`rollButton-${playerIndex}`);
            const diceArea = document.getElementById('diceArea');

            // Disable the button to prevent multiple rolls
            rollButton.disabled = true;

            // Clear the dice area
            diceArea.innerHTML = '';

            // Show dice animation
            for (let i = 0; i < <?php echo $_SESSION['diceCount']; ?>; i++) {
                const dice = document.createElement('div');
                dice.className = 'dice';
                dice.style.backgroundImage = `url('http://193.2.139.22/dice/dice-anim.gif')`;
                diceArea.appendChild(dice);
            }

            // Simulate dice roll animation
            setTimeout(() => {
                let totalScore = 0;
                diceArea.innerHTML = ''; // Clear the dice area for final results

                for (let i = 0; i < <?php echo $_SESSION['diceCount']; ?>; i++) {
                    const diceValue = Math.floor(Math.random() * 6) + 1;
                    totalScore += diceValue;

                    const dice = document.createElement('div');
                    dice.className = 'dice';
                    dice.style.backgroundImage = `url(${diceImages[diceValue - 1]})`;
                    diceArea.appendChild(dice);
                }

                // Update the player's score and rolls left
                results[playerIndex].score += totalScore;
                results[playerIndex].rollsLeft--;
                rollsLeftElement.innerText = results[playerIndex].rollsLeft;
                scoreElement.innerText = results[playerIndex].score;

                // Enable the button if rolls are left, otherwise disable it
                if (results[playerIndex].rollsLeft > 0) {
                    rollButton.disabled = false;
                } else {
                    rollButton.disabled = true;
                }

                // Check if all players are done
                if (results.every(player => player.rollsLeft === 0)) {
                    finishGame();
                }

                isRolling = false; // Reset the flag after rolling is complete
            }, 2000); // 2-second delay for animation
        }

        function finishGame() {
            fetch('save_results.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(results)
            }).then(() => {
                window.location.href = 'results.php';
            });
        }
    </script>
</body>
</html>