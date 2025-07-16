<?php
include('../../connection.php');
header('Content-Type: application/json');

// Pagination & Search
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';

$offset = ($page - 1) * $limit;

// Build filters
$filters = [];
$filters[] = "contact_messages.user = users.id";

if ($search !== "") {
    $filters[] = "(
        users.username LIKE '%$search%' OR 
        contact_messages.subject LIKE '%$search%' OR 
        contact_messages.message LIKE '%$search%'
    )";
}

$where = "WHERE " . implode(" AND ", $filters);

// Main query
$sql = "
    SELECT 
        contact_messages.*, 
        users.username, 
        users.email 
    FROM contact_messages 
    JOIN users ON contact_messages.user = users.id
    $where
    ORDER BY contact_messages.created_at DESC 
    LIMIT $offset, $limit
";

$result = $connection->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Total count
$countSql = "
    SELECT COUNT(*) AS total 
    FROM contact_messages 
    JOIN users ON contact_messages.user = users.id
    $where
";
$countRes = $connection->query($countSql);
$total = $countRes->fetch_assoc()['total'] ?? 0;

// Output JSON
echo json_encode([
    'data' => $messages,
    'total' => $total,
    'page' => $page,
    'limit' => $limit
]);
?>
