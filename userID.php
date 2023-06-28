<?php 
session_start();
require_once './conn.php';
$id = $_POST['id'];

// Fetch the user record from the database
$query = "SELECT * FROM users,clients where users.ID = clients.CreatedBy and CreatedBy = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the user data as JSON response
if ($user) {
  $response = array('success' => true, 'user' => $user);
} else {
  $response = array('success' => false);
}
echo json_encode($response);



?>