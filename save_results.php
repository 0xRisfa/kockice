<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $results = json_decode(file_get_contents('php://input'), true);
    $_SESSION['results'] = $results;
}