<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../import.php'?>
    <title>Submit a found item</title>
</head>
<body>
    <div class="container mt-5">

        <h1 class="text-center mt-5">Submit a found item</h1>

        <form action="foundprocess.php" method="post">

            <div class="form-group">
                <label for="fnd_category">Item Category:</label>
                <select class="form-control" id="fnd_category" name="fnd_category" required>
                    <option value="" disabled selected>-- Select Category --</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Bags">Bags</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Stationery">Stationery</option>
                    <option value="Drinkware">Drinkware</option>
                    <option value="Keys & Cards">Keys & Cards</option>
                    <option value="Others">Others</option>
                </select>
            </div>


            
        </form>

    </div>

    <a href="founddashboard.php" class="btn btn-primary mt-5">Go Back</a>
</body>
</html>