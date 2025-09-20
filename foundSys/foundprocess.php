<?php
include '../dbconnect.php';

$database = new Database();
$conn = $database->getConnect();

try {
    // HANDLE IMAGE UPLOAD
    $fnd_image = null;
    if (isset($_FILES['fnd_image']) && $_FILES['fnd_image']['error'] === 0) {
        $fnd_image = file_get_contents($_FILES['fnd_image']['tmp_name']);
    }

    // GET CURRENT DATETIME
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "INSERT INTO found_items 
            (fnd_category, fnd_name, fnd_desc, fnd_location, fnd_datetime, fndr_name, fndr_number, fndr_email, fnd_status, fnd_image) 
            VALUES 
            (:category, :name, :description, :location, :datetime, :reporter_name, :reporter_number, :reporter_email, 'unclaimed', :image)";

    $stmt = $conn->prepare($sql);

    // PARAM BINDING
    $stmt->bindParam(':category', $_POST['fnd_category']);
    $stmt->bindParam(':name', $_POST['fnd_name']);
    $stmt->bindParam(':description', $_POST['fnd_desc']);
    $stmt->bindParam(':location', $_POST['fnd_location']);
    $stmt->bindParam(':datetime', $currentDateTime);
    $stmt->bindParam(':reporter_name', $_POST['fndr_name']);
    $stmt->bindParam(':reporter_number', $_POST['fndr_contact']);
    $stmt->bindParam(':reporter_email', $_POST['fndr_email']);
    $stmt->bindParam(':image', $fnd_image, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        header("Location: founddashboard.php");
        exit();
    } else {
        echo "Error inserting record.";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
