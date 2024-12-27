<?php
// Hotels.php
include_once('header.php'); // Include database connection
?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <h1>View Hotels</h1>


    <!-- Modal for Adding Hotel -->
    <div id="addHotelModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add New Hotel</h2>
            <form method="POST" action="hotels.php">
                <label for="from_city">City:</label>
                <input class="form-control" type="text" name="city" required><br>
               <label for="check_in_date">Check-In:</label>
                <input class="form-control" type="date" name="check_in_date" required><br>
                <label for="check_out_date">Check-Out:</label>
                <input  class="form-control" type="date" name="check_out_date" required><br>
                <label for="check_out_date">Rooms:</label>
                <input  class="form-control" type="number" name="rooms" required><br>
            
                <label for="adults">Adults:</label>
                <input  class="form-control" type="number" name="adults" min="1" required><br>
                <label for="children">Children:</label>
                <input  class="form-control" type="number" name="children" min="0" required><br>
                <label for="price">Price:</label>
                <input  class="form-control" type="number" name="price" step="0.01" required><br><br>
                <button type="submit" class="btn btn-primary">Add Hotel</button>
            </form>
        </div>
    </div>

    <!-- Hotels Table -->
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>City</th>
                <th>Name</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Rooms</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            // Fetch Hotels data in descending order
            $query = "SELECT * FROM hotels ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['check_in_date']; ?></td>
                    <td><?php echo $row['check_out_date']; ?></td>
                    <td><?php echo $row['rooms']; ?></td>
                    <td><?php echo number_format($row['price']); ?></td>
                    <td>
                    <button class="btn btn-primary">Book Hotel</button>
                </td>
                </tr>
            <?php } } else{
                echo 'No Hotel records';
            } ?>
        </tbody>
    </table>
<?php include_once('footer.php'); ?>
