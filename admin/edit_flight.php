<?php
// edit_flight.php
include_once('header.php'); // Include database connection

// Fetch flight details if 'id' is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM flights WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $flight = mysqli_fetch_assoc($result);
}

// Handle form submission for updating flight
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $from_city = $_POST['from_city'];
    $to_city = $_POST['to_city'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $class = $_POST['class'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $price = $_POST['price'];

    $update_query = "UPDATE flights SET 
        from_city='$from_city', 
        to_city='$to_city', 
        check_in_date='$check_in_date', 
        check_out_date='$check_out_date', 
        class='$class', 
        adult_count='$adults', 
        children_count='$children', 
        price='$price' 
        WHERE id='$id'";

    if (mysqli_query($conn, $update_query)) {
        header('Location: flights.php');
        exit;
    } else {
        echo "Error updating flight: " . mysqli_error($conn);
    }
}
?>
<div class="col-lg-12">
    <h1>Edit Flight</h1>
    <?php if (isset($flight)) { ?>
        <form method="POST" action="edit_flight.php" style="width: 70%; margin-left: 15%;">
            <input type="hidden" name="id" value="<?php echo $flight['id']; ?>">
            <label for="from_city">From:</label>
            <input class="form-control" type="text" name="from_city" value="<?php echo $flight['from_city']; ?>" required><br>
            <label for="to_city">To:</label>
            <input class="form-control" type="text" name="to_city" value="<?php echo $flight['to_city']; ?>" required><br>
            <label for="check_in_date">Check-In:</label>
            <input class="form-control" type="date" name="check_in_date" value="<?php echo $flight['check_in_date']; ?>" required><br>
            <label for="check_out_date">Check-Out:</label>
            <input class="form-control" type="date" name="check_out_date" value="<?php echo $flight['check_out_date']; ?>" required><br>
            <label for="class">Class:</label>
            <select class="form-control" name="class" required>
                <option value="Economy" <?php if ($flight['class'] === 'Economy') echo 'selected'; ?>>Economy</option>
                <option value="Business" <?php if ($flight['class'] === 'Business') echo 'selected'; ?>>Business</option>
                <option value="First" <?php if ($flight['class'] === 'First') echo 'selected'; ?>>First</option>
            </select><br>
            <label for="adults">Adults:</label>
            <input class="form-control" type="number" name="adults" min="1" value="<?php echo $flight['adult_count']; ?>" required><br>
            <label for="children">Children:</label>
            <input class="form-control" type="number" name="children" min="0" value="<?php echo $flight['children_count']; ?>" required><br>
            <label for="price">Price:</label>
            <input class="form-control" type="number" name="price" step="0.01" value="<?php echo $flight['price']; ?>" required><br><br>
            <button type="submit" class="btn btn-primary">Update Flight</button>
        </form>
    <?php } else { ?>
        <p>Flight not found.</p>
    <?php } ?>
    </div>
<?php include_once('footer.php'); ?>
