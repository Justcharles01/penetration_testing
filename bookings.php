<?php
// Include your database connection file
include('header.php');

$user_id = $_SESSION['user_id'];

// Fetch booked flights for the user
$flights_query = "SELECT flights.from_city, flights.to_city, flights.check_in_date, flights.check_out_date, flights.class, flights.price, bookings.date 
                  FROM bookings 
                  JOIN flights ON bookings.type_id = flights.id 
                  WHERE bookings.type = 'flight' AND bookings.user_id = '$user_id'";
$flights_result = mysqli_query($conn, $flights_query);

// Fetch booked hotels for the user
$hotels_query = "SELECT hotels.name, hotels.city, hotels.check_in_date, hotels.check_out_date, hotels.price, hotels.rooms, bookings.date 
                 FROM bookings 
                 JOIN hotels ON bookings.type_id = hotels.id 
                 WHERE bookings.type = 'hotel' AND bookings.user_id = '$user_id'";
$hotels_result = mysqli_query($conn, $hotels_query);
?>

    <style>
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .containers {
            max-width: 900px;
            margin: auto;
        }
        .no-bookings {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="containers">
        <h1>My Bookings</h1>

        <!-- Booked Flights -->
        <h2>Booked Flights</h2>
        <?php if (mysqli_num_rows($flights_result) > 0){ ?>
            <table>
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Class</th>
                        <th>Price</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($flight = mysqli_fetch_assoc($flights_result)){ ?>
                        <tr>
                            <td><?php echo $flight['from_city']; ?></td>
                            <td><?php echo $flight['to_city']; ?></td>
                            <td><?php echo $flight['check_in_date']; ?></td>
                            <td><?php echo $flight['check_out_date']; ?></td>
                            <td><?php echo $flight['class']; ?></td>
                            <td>$<?php echo number_format($flight['price']); ?></td>
                            <td><?php echo $flight['date']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <p class="no-bookings">No flights booked yet.</p>
        <?php } ?>

        <!-- Booked Hotels -->
        <h2>Booked Hotels</h2>
        <?php if (mysqli_num_rows($hotels_result) > 0){ ?>
            <table>
                <thead>
                    <tr>
                        <th>Hotel Name</th>
                        <th>Location</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Rooms</th>
                        <th>Price</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($hotel = mysqli_fetch_assoc($hotels_result)){ ?>
                        <tr>
                            <td><?php echo $hotel['name']; ?></td>
                            <td><?php echo $hotel['city']; ?></td>
                            <td><?php echo $hotel['check_in_date']; ?></td>
                            <td><?php echo $hotel['check_out_date']; ?></td>
                            <td><?php echo $hotel['rooms']; ?></td>
                            <td>$<?php echo $hotel['price']; ?></td>
                            <td><?php echo $hotel['date']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <p class="no-bookings">No hotels booked yet.</p>
        <?php } ?>
    </div>
<?php include_once('footer.php'); ?>
