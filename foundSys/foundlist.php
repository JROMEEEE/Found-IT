<?php
include '../dbconnect.php';

$database = new Database();
$conn = $database->getConnect();

try {
    $sql = "SELECT fnd_id, fnd_name, fnd_desc, fnd_location, fnd_datetime, fnd_image, fnd_status 
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
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain; 
            background-color: #f8f9fa;
        }
        .status-badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 0.25rem;
        }
        .status-unclaimed {
            background-color: #198754;
            color: white;
        }
        .status-claimed {
            background-color: #dc3545;
            color: white;
        }
 
        .modal-lg {
            max-width: 900px;
        }

        .fixed-modal-body {
            min-height: 400px;
        }

        .modal-img {
            max-width: 100%;
            max-height: 350px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Found Items</h1>

        <div class="row">
            <?php if (count($items) > 0): ?>
                <?php foreach ($items as $item): ?>
                    <?php $status = $item['fnd_status'] ?? 'unclaimed'; ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">

                            <?php if (!empty($item['fnd_image'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($item['fnd_image']) ?>" 
                                    class="card-img-top mt-3" 
                                    alt="<?= htmlspecialchars($item['fnd_name']) ?>">
                            <?php else: ?>
                                <img src="../assets/no_image.png" 
                                    class="card-img-top mt-3" 
                                    alt="No image available">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['fnd_name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($item['fnd_desc']) ?></p>

                                <!-- STATUS BADGE -->
                                <span class="status-badge <?= $status === 'claimed' ? 'status-claimed' : 'status-unclaimed' ?>">
                                    <?= ucfirst($status) ?>
                                </span>

                                <!-- SHOW BUTTON IF UNCLAIMED -->
                                <?php if ($status === 'unclaimed'): ?>
                                    <div class="mt-3">
                                        <!-- BUTTON TO VIEW ITEM -->
                                        <button type="button" 
                                            class="btn btn-primary" 
                                            data-toggle="modal" 
                                            data-target="#itemModal<?= $item['fnd_id'] ?>">
                                            View Item
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-footer">
                                <small class="text-muted">
                                    Location: <?= htmlspecialchars($item['fnd_location']) ?><br>
                                    Date: <?= htmlspecialchars($item['fnd_datetime']) ?> <br>
                                    Item ID: <?= $item['fnd_id'] ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL -->
                    <div class="modal fade" id="itemModal<?= $item['fnd_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                
                                <div class="modal-header d-flex justify-content-between align-items-center">
                                    <h5 class="modal-title mb-0"><?= htmlspecialchars($item['fnd_name']) ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                
                                <div class="modal-body fixed-modal-body">
                                    <div class="row">
                                        
                                        <!-- LEFT SIDE: INFO -->
                                        <div class="col-md-6">
                                            <p><strong>Description:</strong> <?= htmlspecialchars($item['fnd_desc']) ?></p>
                                            <p><strong>Location:</strong> <?= htmlspecialchars($item['fnd_location']) ?></p>
                                            <p><strong>Date Found:</strong> <?= htmlspecialchars($item['fnd_datetime']) ?></p>
                                            <p><strong>Status:</strong> <?= ucfirst($status) ?></p>
                                        </div>
                                        
                                        <!-- RIGHT SIDE: IMAGE -->
                                        <div class="col-md-6 text-center d-flex justify-content-center align-items-center">
                                            <?php if (!empty($item['fnd_image'])): ?>
                                                <img src="data:image/jpeg;base64,<?= base64_encode($item['fnd_image']) ?>" 
                                                    class="modal-img" 
                                                    alt="Item Image">
                                            <?php else: ?>
                                                <img src="../assets/no_image.png" 
                                                    class="modal-img" 
                                                    alt="No image available">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL FOOTER -->
                                <div class="modal-footer">

                                    <!-- UPDATE -->
                                    <a href="" class="btn btn-primary">
                                        Update
                                    </a>

                                    <!-- DELETE -->
                                    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display:inline;">
                                        <input type="hidden" name="fnd_id" value="<?= $item['fnd_id'] ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                
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
