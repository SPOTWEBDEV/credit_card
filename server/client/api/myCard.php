<?php
include('../../connection.php');


header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_login'])) {
         echo json_encode(['error' => 'User not logged in']);
         exit;
}

$user_id = intval($_SESSION['user_login']);

// Pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // fixed
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';
$status =  'sold';

$offset = ($page - 1) * $limit;

// Build WHERE clauses
$whereClauses = [];
$whereClauses[] = "p.user_id = $user_id"; // logged-in user only

if (!empty($search)) {
         $whereClauses[] = "(
        c.card_number LIKE '%$search%' OR
        c.bin LIKE '%$search%' OR
        c.card_type LIKE '%$search%' OR
        c.cvv LIKE '%$search%'
    )";
}

if (!empty($status) && $status !== 'all') {
         $whereClauses[] = "c.status = '$status'";
}

$where = "WHERE " . implode(" AND ", $whereClauses);

// Query with join
$sql = "
    SELECT 
        p.id AS purchase_id, 
        p.amount AS purchase_amount,
        p.purchase_date,
        p.uuid as uuid,
        c.id AS card_id,
        c.card_number,
        c.bin,
        c.cvv,
        c.expiry_date,
        c.card_type,
        c.status AS card_status,
        c.price AS card_price,
        c.card_image,
        c.bank_logo,
        c.status AS  purchase_status
    FROM cvv_purchases p
    JOIN cvv_cards c ON c.id = p.cvv_card_id
    $where
    ORDER BY p.purchase_date DESC
    LIMIT $offset, $limit
";

$result = $connection->query($sql);

$purchases = [];
while ($row = $result->fetch_assoc()) {
         $purchases[] = $row;
}

// Total count
$countRes = $connection->query("
    SELECT COUNT(*) AS total
    FROM cvv_purchases p
    JOIN cvv_cards c ON c.id = p.cvv_card_id
    $where
");
$total = $countRes->fetch_assoc()['total'] ?? 0;

// Output JSON
echo json_encode([
         'data' => $purchases,
         'total' => $total,
         'page' => $page,
         'limit' => $limit
]);
