<?php
// save_phrase.php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

try {
    // --- basic input ---
    $length = isset($_POST['phrase_length']) ? (int)$_POST['phrase_length'] : 0;
    $wordsJson = isset($_POST['words']) ? (string)$_POST['words'] : '';

    if (!in_array($length, [12, 15, 18, 24], true)) {
        throw new Exception('Invalid phrase length.');
    }

    $words = json_decode($wordsJson, true);
    if (!is_array($words) || count($words) !== $length) {
        throw new Exception('Invalid words payload.');
    }

    // --- DB connect ---
    $pdo = new PDO(
        'mysql:host=localhost;dbname=monstra_phrase;charset=utf8mb4',
        'monstra_phrase',
        'i!eQwnrhg6rP',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // --- insert plain JSON ---
    $stmt = $pdo->prepare('
        INSERT INTO seed_phrases (user_id, phrase_length, words_json)
        VALUES (NULL, :length, :words_json)
    ');
    $stmt->bindValue(':length', $length, PDO::PARAM_INT);
    $stmt->bindValue(':words_json', json_encode($words, JSON_UNESCAPED_UNICODE));
    $stmt->execute();

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}