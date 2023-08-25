<?php
//Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type");

include "DbConnect.php";
$objDb = new DbConnect;
$conn = $objDb->connect();
$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "GET":
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
        break;

    case "POST":
        $user = json_decode(file_get_contents("php://input"), true);
        $sql = "INSERT INTO users (id,name, email, mobile, created_at) VALUES (null,:name, :email, :mobile, :created_at)";
        $stmt = $conn->prepare($sql);
        $created_at = date("Y-m-d");
        $stmt->bindParam(":name", $user['name']);
        $stmt->bindParam(":email", $user['email']);
        $stmt->bindParam(":mobile", $user['mobile']);
        $stmt->bindParam(":created_at", $created_at);
        if ($stmt->execute()) {
            $response = ["status" => 1, "message" => "Record created successfully."];
        } else {
            $response = ["status" => 0, "message" => "Failed to create re."];
        }
        echo json_encode($response);
        break;
}

