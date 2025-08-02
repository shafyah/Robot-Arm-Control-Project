<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot-arm";

$motor1 = isset($_POST["motor1"]) ? (int)$_POST["motor1"] : 0;
$motor2 = isset($_POST["motor2"]) ? (int)$_POST["motor2"] : 0;
$motor3 = isset($_POST["motor3"]) ? (int)$_POST["motor3"] : 0;
$motor4 = isset($_POST["motor4"]) ? (int)$_POST["motor4"] : 0;
$motor5 = isset($_POST["motor5"]) ? (int)$_POST["motor5"] : 0;
$motor6 = isset($_POST["motor6"]) ? (int)$_POST["motor6"] : 0;


if (!$motor1 && !$motor2 && !$motor3 && !$motor4 && !$motor5 && !$motor6) {
    die("Error: motor values are required.");
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO poses (motor1, motor2, motor3, motor4, motor5, motor6) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiii", $motor1, $motor2, $motor3, $motor4, $motor5, $motor6);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
