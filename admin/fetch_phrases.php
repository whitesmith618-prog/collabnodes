<?php
// fetch_phrases.php
header('Content-Type: application/json; charset=utf-8');

try {
    // --- config your DB here ---
    $pdo = new PDO(
        'mysql:host=localhost;dbname=monstra_phrase;charset=utf8mb4',
        'monstra_phrase',
        'i!eQwnrhg6rP',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // inputs
    $page  = isset($_GET['page'])  ? max(1, (int)$_GET['page']) : 1;
    $limit = isset($_GET['limit']) ? max(1, min(200, (int)$_GET['limit'])) : 25;
    $q     = isset($_GET['q'])     ? trim((string)$_GET['q']) : '';
    $offset = ($page - 1) * $limit;

    // build WHERE
    $where  = [];
    $params = [];

    if ($q !== '') {
        $like = '%' . $q . '%';
        $where[] = '(words_json LIKE :like OR CAST(id AS CHAR) LIKE :like OR CAST(user_id AS CHAR) LIKE :like)';
        $params[':like'] = $like;
    }
    $whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

    // total
    $stmt = $pdo->prepare("SELECT COUNT(*) AS c FROM seed_phrases $whereSql");
    foreach ($params as $k=>$v) $stmt->bindValue($k, $v, PDO::PARAM_STR);
    $stmt->execute();
    $total = (int)$stmt->fetchColumn();

    // page rows
    $stmt = $pdo->prepare("
        SELECT id, user_id, phrase_length, words_json, created_at
        FROM seed_phrases
        $whereSql
        ORDER BY id DESC
        LIMIT :offset, :lim
    ");
    foreach ($params as $k=>$v) $stmt->bindValue($k, $v, PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':lim',    $limit,  PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'page'    => $page,
        'limit'   => $limit,
        'total'   => $total,
        'data'    => $rows,
    ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}