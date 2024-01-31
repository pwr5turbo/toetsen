<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "top2000";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $id = $_GET['id'];
  $sql = "DELETE FROM artist WHERE id=$id";

  $conn->exec($sql);
  echo "Record deleted successfully";
  header("location: CRUD.php");
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>