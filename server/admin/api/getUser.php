<?php
include('../../connection.php');

header('Content-Type: application/json');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';
$status = isset($_GET['status']) ? $connection->real_escape_string($_GET['status']) : '';

$offset = ($page - 1) * $limit;

// Build WHERE clauses
$whereClauses = [];
if (!empty($search)) {
    $whereClauses[] = "username LIKE '%$search%'";
}

if (!empty($status) && $status !== 'all') {
    $whereClauses[] = "status = '$status'";
}

$where = '';
if (!empty($whereClauses)) {
    $where = "WHERE " . implode(" AND ", $whereClauses);
}

$sql = "SELECT * FROM users $where LIMIT $offset, $limit";
$result = $connection->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$countRes = $connection->query("SELECT COUNT(*) AS total FROM users $where");
$total = $countRes->fetch_assoc()['total'] ?? 0;

echo json_encode([
    'data' => $users,
    'total' => $total,
    'page' => $page,
    'limit' => $limit
]);
