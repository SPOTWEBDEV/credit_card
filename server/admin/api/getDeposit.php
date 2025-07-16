<?php
include('../../connection.php');

header('Content-Type: application/json');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // fixed
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';
$status = isset($_GET['status']) ? $connection->real_escape_string($_GET['status']) : '';

$offset = ($page - 1) * $limit;

// Build WHERE clauses
$whereClauses = [];
if (!empty($search)) {
         $whereClauses[] = "(d.payment_method LIKE '%$search%' 
                        OR d.amount LIKE '%$search%' 
                        OR u.username LIKE '%$search%' 
                        OR u.email LIKE '%$search%')";
}

// Add only if status is *not* 'all'
if (!empty($status) && $status !== 'all') {
         $whereClauses[] = "d.status = '$status'";
}

$where = "";
if (!empty($whereClauses)) {
         $where = "WHERE " . implode(" AND ", $whereClauses);
}

// Query deposits with join
$sql = "
    SELECT  d.id, d.deposts_id , d.amount, d.date, d.status, d.payment_method, d.image,
           u.id AS user_id, u.username, u.email
    FROM deposits d
    JOIN users u ON u.id = d.user
    $where
    ORDER BY d.date DESC
    LIMIT $offset, $limit
";

$result = $connection->query($sql);

$deposits = [];
while ($row = $result->fetch_assoc()) {
         $deposits[] = $row;
}

// Get total count for pagination
$countRes = $connection->query("
    SELECT COUNT(*) AS total 
    FROM deposits d
    JOIN users u ON u.id = d.user
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
