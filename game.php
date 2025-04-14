<?php
session_start();

if (!isset($_SESSION['users'])) {
    // Redirect back to the index page if no users are set
    header("Location: index.php");
    exit();
}

// Generate dice rolls and calculate scores
$results = [];
foreach ($_SESSION['users'] as $user) {
    $diceRolls = [rand(1, 6), rand(1, 6), rand(1, 6)];
    $totalScore = array_sum($diceRolls);
    $results[] = ['user' => $user, 'dice' => $diceRolls, 'score' => $totalScore];
}

// Store results in session
$_SESSION['results'] = $results;

// Redirect to the results page
header("Location: results.php");
exit();
?>