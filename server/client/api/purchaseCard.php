<?php


include('../../connection.php');

header('Content-Type: application/json');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10; // fixed at 10
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';
$status = 'available';

$offset = ($page - 1) * $limit;

$whereClauses = [];
if (!empty($search)) {
         $whereClauses[] = "(card_number LIKE '%$search%' OR bin LIKE '%$search%' OR card_type LIKE '%$search%')";
}
if (!empty($status)) {
         $whereClauses[] = "status = '$status'";
}

$where = "";
if (!empty($whereClauses)) {
         $where = "WHERE " . implode(" AND ", $whereClauses);
}

$sql = "SELECT * FROM cvv_cards $where ORDER BY created_at DESC LIMIT $offset, $limit";
$result = $connection->query($sql);

$cards = [];
while ($row = $result->fetch_assoc()) {
         // Mask and format card number
         $originalNumber = $row['card_number'];

         

         $row['card_number'] = maskCardNumber($originalNumber);

         $cards[] = $row;
}

$countRes = $connection->query("SELECT COUNT(*) AS total FROM cvv_cards $where");
$total = $countRes->fetch_assoc()['total'];

echo json_encode([
         'data' => $cards,
         'total' => $total,
         'page' => $page,
         'limit' => $limit
]);


?>