<?php 
session_start();
require_once './conn.php';
$id = $_POST['id'];

// Fetch the user record from the database
$query = "SELECT * FROM users where ID = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$output['data'] = $stmt->fetch();
header('Content-Type: application/json');
echo json_encode($output);
// Return the user data as JSON response
// if ($user) {
//   $response = array('success' => true, 'user' => $user);
// } else {
//   $response = array('success' => false);
// }
// echo json_encode($response);



?>