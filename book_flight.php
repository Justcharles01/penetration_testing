<?php
// Include your database connection file
include('header.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $flight_id = $_GET['id'];

    // Fetch the flight details from the database
    $query = "SELECT * FROM flights WHERE id='$flight_id'";
    $result = mysqli_query($conn, $query);

    // Check if the flight exists
    if ($result && mysqli_num_rows($result) > 0) {
        $flight = mysqli_fetch_assoc($result);
    } else {
        echo "Flight not found!";
        exit;
    }
} 

// Handle booking confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $type_id = $_POST['flight_id'];
    $type = 'flight';

    // Insert booking into a 'bookings' table
    $booking_query = "INSERT INTO bookings (type_id, type, user_id) VALUES ('$type_id', '$type', '$user_id')";
    if (mysqli_query($conn, $booking_query)) {
        echo "<script>alert('Flight booked successfully!'); window.location.href='home.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

    <style>
        .containers {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>

    <div class="containers">
        <h2>Book Flight</h2>
        <p><strong>Flight Details:</strong></p>
        <ul>
            <li><strong>From:</strong> <?php echo $flight['from_city']; ?></li>
            <li><strong>To:</strong> <?php echo $flight['to_city']; ?></li>
            <li><strong>Check-In:</strong> <?php echo $flight['check_in_date']; ?></li>
            <li><strong>Check-Out:</strong> <?php echo $flight['check_out_date']; ?></li>
            <li><strong>Class:</strong> <?php echo $flight['class']; ?></li>
            <li><strong>Price:</strong> $<?php echo number_format($flight['price']); ?></li>
        </ul>
        <form method="POST" action="book_flight.php">
            <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
            <button type="submit">Confirm Booking</button>
        </form>
    </div>
<?php include_once('footer.php'); ?>
