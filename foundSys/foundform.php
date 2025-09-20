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

        <form action="foundprocess.php" method="post" enctype="multipart/form-data">

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
                    <option value="Keys">Keys & Cards</option>
                    <option value="Sensitive">Sensitive Items</option>
                    <option value="Others">Others</option>
                </select>

                <label for="fnd_name" class="mt-3">Item Name:</label>
                <input type="text" class="form-control" id="fnd_name" name="fnd_name" placeholder="Item Name" required>

                <label for="fnd_description" class="mt-3">Item Description:</label>
                <textarea class="form-control" id="fnd_desc" name="fnd_desc" placeholder="Describe the item"></textarea>

                <label for="fnd_location" class="mt-3">Item Location:</label>
                <select class="form-control" id="fnd_location" name="fnd_location" required>
                    <option value="" disabled selected>-- Select Location --</option>
                    <option value="GZB">GZB Building (LDC)</option>
                    <option value="VMB">VMB Building (HEB)</option>
                    <option value="AAB">AAB Building (OB)</option>
                    <option value="Facade">Facade/Gate</option>
                </select>

                <label for="fnd_status" class="mt-3">Status of Item:</label>
                <textarea class="form-control" name="fnd_status" id="fnd_status" placeholder="Damaged/Good Condition/Others. Leave blank if not applicable"></textarea>

                <label for="fnd_image" class="mt-3">Upload Image:</label>
                <input type="file" class="form-control" id="fnd_image" name="fnd_image" accept="image/*" capture>


                <!-- FOUNDER INFO -->
                <div class="container mt-3 mb-5">
                    <h3 class="text-center mt-5">Founder Information</h3>

                    <label for="fndr_name">Found by:</label>
                    <input type="text" class="form-control" id="fndr_name" name="fndr_name" placeholder="Name of founder" required>

                    <label for="fndr_number" class="mt-3">Contact Number:</label>
                    <input type="text" class="form-control" id="fndr_contact" name="fndr_contact" placeholder="Contact Number" required>

                    <label for="fndr_email" class="mt-3">Email:</label>
                    <input type="email" class="form-control" id="fndr_email" name="fndr_email" placeholder="Email" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </form>

    </div>

    <a href="founddashboard.php" class="btn btn-primary mt-5">Go Back</a>
</body>
</html>