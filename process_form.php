<?php
$host = 'localhost';
$database = 'your_database';
$username = 'your_username';
$password = 'your_password';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $terms = isset($_POST["terms"]) ? 1 : 0;
    $image = $_FILES["image"];

    if ($terms != 1) {
        http_response_code(400);
        echo "Terms and Conditions must be accepted.";
        exit;
    }


    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($image["name"]);

    if (move_uploaded_file($image["tmp_name"], $targetFile)) {
        list($width, $height) = getimagesize($targetFile);
        if ($width > 500 || $height > 500) {

            $newWidth = min($width, 500);
            $newHeight = ($height / $width) * $newWidth;


            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            $sourceImage = imagecreatefromjpeg($targetFile);


            imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagejpeg($newImage, $targetFile, 90);


            imagedestroy($newImage);
            imagedestroy($sourceImage);
        }
        try {

            $sql = "INSERT INTO Requests (email, name, image_path) VALUES (:email, :name, :image_path)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':name', $name);
            if (!empty($_FILES["image"]["name"])) {
                $stmt->bindParam(':image_path', $targetFile);
            } else {
                $stmt->bindValue(':image_path', null, PDO::PARAM_NULL);
            }
            if ($stmt->execute()) {
                echo "Data has been saved to the database.";
            } else {
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error uploading the image.";
    }
}
