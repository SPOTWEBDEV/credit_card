<?php
include('../../connection.php');


header('Content-Type: application/json');

// Get logged-in user id
if (!isset($_SESSION['user_login'])) {
         echo json_encode(['error' => 'User not logged in']);
         exit;
}

$user_id = intval($_SESSION['user_login']);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // fixed
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';
$status = isset($_GET['status']) ? $connection->real_escape_string($_GET['status']) : '';

$offset = ($page - 1) * $limit;

// Build WHERE clauses
$whereClauses = [];
$whereClauses[] = "user = $user_id"; // always limit to logged-in user

if (!empty($search)) {
         $whereClauses[] = "(payment_method LIKE '%$search%' OR amount LIKE '%$search%')";
}

if (!empty($status) && $status !== 'all') {
         $whereClauses[] = "status = '$status'";
}

$where = "WHERE " . implode(" AND ", $whereClauses);

// Query deposits
$sql = "
    SELECT id, amount, date, status, payment_method, image
    FROM deposits
    $where
    ORDER BY date DESC
    LIMIT $offset, $limit
";

$result = $connection->query($sql);

$deposits = [];
while ($row = $result->fetch_assoc()) {
         $deposits[] = $row;
}

// Get total count
$countRes = $connection->query("
    SELECT COUNT(*) AS total
    FROM deposits
    $where
");
$total = $countRes->fetch_assoc()['total'] ?? 0;

// Return JSON
echo json_encode([
         'data' => $deposits,
         'total' => $total,
         'page' => $page,
         'limit' => $limit
]);
