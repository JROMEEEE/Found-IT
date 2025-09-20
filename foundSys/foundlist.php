<?php
include '../dbconnect.php';

$database = new Database();
$conn = $database->getConnect();

try {
    $sql = "SELECT fnd_id, fnd_name, fnd_desc, fnd_location, fnd_datetime, fnd_image 
            FROM found_items 
            ORDER BY fnd_datetime DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../import.php'?>
    <title>Found Items</title>
</head>
<body>
    <div class="container mt-5">
    <h1 class="text-center mb-5">Found Items</h1>

    <div class="row">
            <style>
                .card-img-top {
                    width: 100%;
                    height: 200px; /* FIXED SIZE */
                    object-fit: contain; 
                    background-color: #f8f9fa;
                }
            </style>

            <?php if (count($items) > 0): ?>
                <?php foreach ($items as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php if (!empty($item['fnd_image'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($item['fnd_image']) ?>" 
                                    class="card-img-top" 
                                    alt="<?= htmlspecialchars($item['fnd_name']) ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x200?text=No+Image" 
                                    class="card-img-top" 
                                    alt="No image available">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['fnd_name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($item['fnd_desc']) ?></p>

                                <!-- BUTTON -->
                                <a href="" class="btn btn-primary">View Item</a>
                            </div>

                            <div class="card-footer">
                                <small class="text-muted">
                                    Location: <?= htmlspecialchars($item['fnd_location']) ?><br>
                                    Date: <?= htmlspecialchars($item['fnd_datetime']) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No items found.</p>
            <?php endif; ?>
        </div>

    </div>



    <a href="founddashboard.php" class="btn btn-primary mt-5">Go Back</a>
</body>
</html>