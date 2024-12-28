<?php
// Include your database connection file
include('header.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $hotel_id = $_GET['id'];

    // Fetch the hotel details from the database
    $query = "SELECT * FROM hotels WHERE id='$hotel_id'";
    $result = mysqli_query($conn, $query);

    // Check if the hotel exists
    if ($result && mysqli_num_rows($result) > 0) {
        $hotel = mysqli_fetch_assoc($result);
    } else {
        echo "Hotel not found!";
        exit;
    }
} 
// Handle booking confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $type_id = $_POST['hotel_id'];
    $type = 'hotel';

    // Insert booking into a 'bookings' table
    $booking_query = "INSERT INTO bookings (type_id, type, user_id) VALUES ('$type_id', '$type', '$user_id')";
    if (mysqli_query($conn, $booking_query)) {
        echo "<script>alert('Hotel booked successfully!'); window.location.href='home.php';</script>";
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
        <h2>Book Hotel</h2>
        <p><strong>Hotel Details:</strong></p>
        <ul>
            <li><strong>Hotel Name:</strong> <?php echo $hotel['name']; ?></li>
            <li><strong>City:</strong> <?php echo $hotel['city']; ?></li>
            <li><strong>Check-In:</strong> <?php echo $hotel['check_in_date']; ?></li>
            <li><strong>Check-Out:</strong> <?php echo $hotel['check_out_date']; ?></li>
            <li><strong>Rooms:</strong> <?php echo $hotel['rooms']; ?></li>
            <li><strong>Price:</strong> $<?php echo number_format($hotel['price']); ?></li>
        </ul>
        <form method="POST" action="book_hotel.php">
            <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
            <button type="submit">Confirm Booking</button>
        </form>
    </div>
<?php include_once('footer.php'); ?>
