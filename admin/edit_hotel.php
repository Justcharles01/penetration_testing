<?php
// edit_hotel.php
include_once('header.php'); // Include database connection

// Fetch hotel details if 'id' is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM hotels WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $hotel = mysqli_fetch_assoc($result);
}

// Handle form submission for updating hotel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $city = $_POST['city'];
    $name = $_POST['name'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $rooms = $_POST['rooms'];
    $price = $_POST['price'];

    $update_query = "UPDATE hotels SET 
        city='$city', 
        name='$name', 
        check_in_date='$check_in_date', 
        check_out_date='$check_out_date', 
        rooms='$rooms', 
        price='$price' 
        WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        header('Location: hotels.php');
        exit;
    } else {
        echo "Error updating hotel: " . mysqli_error($conn);
    }
}
?>
<div class="col-lg-12">
    <h1>Edit Hotel</h1>
    <?php if (isset($hotel)) { ?>
        <form method="POST" action="edit_hotel.php" style="width: 70%; margin-left: 15%;">
            <input type="hidden" name="id" value="<?php echo $hotel['id']; ?>">
           <label for="city">City:</label>
            <input class="form-control" type="text" name="city" value="<?php echo $hotel['city']; ?>" required><br>
            <label for="city">Name:</label>
            <input class="form-control" type="text" name="name" value="<?php echo $hotel['name']; ?>" required><br>
            <label for="check_in_date">Check-In:</label>
            <input class="form-control" type="date" name="check_in_date" value="<?php echo $hotel['check_in_date']; ?>" required><br>
            <label for="check_out_date">Check-Out:</label>
            <input class="form-control" type="date" name="check_out_date" value="<?php echo $hotel['check_out_date']; ?>" required><br>
            <label for="adults">Rooms:</label>
            <input class="form-control" type="number" name="rooms" min="1" value="<?php echo $hotel['rooms']; ?>" required><br>
           <label for="price">Price:</label>
            <input class="form-control" type="number" name="price" step="0.01" value="<?php echo $hotel['price']; ?>" required><br><br>
            <button type="submit" class="btn btn-primary">Update Hotel</button>
        </form>
    <?php } else { ?>
        <p>Hotel not found.</p>
    <?php } ?>
    </div>
<?php include_once('footer.php'); ?>
