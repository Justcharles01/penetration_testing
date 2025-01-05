<?php
include_once('header.php');
?>
<style>
        .profile-card {
            width: 80%;
            background-color: #f4f4f4;
            background-image: url('images/loc.png');
            background-repeat: no-repeat;
            padding: 50px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      
        }
        .profile-card h2 {
            margin-bottom: 20px;
            padding-left: 10%;
        }
        .profile-card p {
            margin: 15px 0;
        }
    </style>

<div class="profile-card">
    <?php 
    $user_id = $_SESSION['user_id'];
    // Fetch flights data in descending order
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) { ?>
    <h2><?php echo ucfirst($row['username']); ?></h2>
    <p><strong>Full Name:</strong> <?php echo $row['fullname']; ?></p>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
    <?php } } ?>
</div>



<?php
include_once('footer.php'); 
?>