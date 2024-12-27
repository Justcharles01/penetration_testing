<?php
// flights.php
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

    <h1>View Flights</h1>

   

    <!-- Flights Table -->
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>From</th>
                <th>To</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Class</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            // Fetch flights data in descending order
            $query = "SELECT * FROM flights ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['from_city']; ?></td>
                    <td><?php echo $row['to_city']; ?></td>
                    <td><?php echo $row['check_in_date']; ?></td>
                    <td><?php echo $row['check_out_date']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['adult_count']; ?></td>
                    <td><?php echo $row['children_count']; ?></td>
                    <td><?php echo number_format($row['price']); ?></td>
                    <td>
                        <button class="btn btn-primary">Book Flight</button>
                     </td>
                </tr>
            <?php } } else{
                echo 'No Flights records';
            } ?>
        </tbody>
    </table>

<?php include_once('footer.php'); ?>
