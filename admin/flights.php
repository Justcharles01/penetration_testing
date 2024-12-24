<?php
// flights.php
include_once('header.php'); // Include database connection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type']; // flights, hotels, or packages
    if ($type === 'flights') {
        $from = $_POST['from_city'];
        $to = $_POST['to_city'];
        $check_in = $_POST['check_in_date'];
        $check_out = $_POST['check_out_date'];
        $class = $_POST['class'];
        $adults = $_POST['adults'];
        $children = $_POST['children'];
        $price = $_POST['price'];

        $query = "INSERT INTO flights (from_city, to_city, check_in_date, check_out_date, class, adult_count, children_count, price)
                  VALUES ('$from', '$to', '$check_in', '$check_out', '$class', '$adults', '$children', '$price')";
        if(mysqli_query($conn, $query)==true){
            echo 'Flights Inserted Successfully';
        }else{
            echo 'Erro Inserting, Try Later';
        }
    }
    // Similar logic for hotels and packages
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $delete_query = "DELETE FROM flights WHERE id='$id'";
    mysqli_query($conn, $delete_query);
    header('Location: flights.php');
    exit;
}
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

    <h1>Manage Flights</h1>

    <!-- Add Flight Button -->
    <button id="addFlightBtn" class="btn btn-primary">Add Flight</button>

    <!-- Modal for Adding Flight -->
    <div id="addFlightModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add New Flight</h2>
            <form method="POST" action="flights.php">
                <label for="from_city">From:</label>
                <input class="form-control" type="text" name="from_city" required><br>
                <label for="to_city">To:</label>
                <input  class="form-control" type="text" name="to_city" required><br>
                <label for="check_in_date">Check-In:</label>
                <input class="form-control" type="date" name="check_in_date" required><br>
                <label for="check_out_date">Check-Out:</label>
                <input  class="form-control" type="date" name="check_out_date" required><br>
                <label for="class">Class:</label>
                <select  class="form-control" name="class">
                    <option value="Economy">Economy</option>
                    <option value="Business">Business</option>
                    <option value="First">First</option>
                </select><br>
                <label for="adults">Adults:</label>
                <input  class="form-control" type="number" name="adults" min="1" required><br>
                <label for="children">Children:</label>
                <input  class="form-control" type="number" name="children" min="0" required><br>
                <label for="price">Price:</label>
                <input  class="form-control" type="number" name="price" step="0.01" required><br><br>
                <button type="submit" class="btn btn-primary">Add Flight</button>
            </form>
        </div>
    </div>

    <!-- Flights Table -->
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>ID</th>
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
            
            // Fetch flights data in descending order
            $query = "SELECT * FROM flights ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['from_city']; ?></td>
                    <td><?php echo $row['to_city']; ?></td>
                    <td><?php echo $row['check_in_date']; ?></td>
                    <td><?php echo $row['check_out_date']; ?></td>
                    <td><?php echo $row['class']; ?></td>
                    <td><?php echo $row['adult_count']; ?></td>
                    <td><?php echo $row['children_count']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td>
                        <a href="edit_flight.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="flights.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this flight?');">Delete</a>
                    </td>
                </tr>
            <?php } } else{
                echo 'No Flights records';
            } ?>
        </tbody>
    </table>

    <script>
        // Modal functionality
        const modal = document.getElementById('addFlightModal');
        const btn = document.getElementById('addFlightBtn');
        const span = document.getElementById('closeModal');

        btn.onclick = function() {
            modal.style.display = 'block';
        }

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    </script>
<?php include_once('footer.php'); ?>
