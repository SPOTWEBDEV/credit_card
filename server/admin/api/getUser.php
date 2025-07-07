<?php
// fetch_users.php

include('../../connection.php');

header('Content-Type: application/json');



$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$search = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';

$offset = ($page - 1) * $limit;

$where = "";
if ($search != "") {
    $where = "WHERE username LIKE '%$search%'";
}

$sql = "SELECT * FROM users $where LIMIT $offset, $limit";
$result = $connection->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$countRes = $connection->query("SELECT COUNT(*) AS total FROM users $where");
$total = $countRes->fetch_assoc()['total'];

echo json_encode([
    'data' => $users,
    'total' => $total,
    'page' => $page,
    'limit' => $limit
]);
?>
