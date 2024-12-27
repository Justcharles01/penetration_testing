<?php 
include_once('header.php'); 
?>
<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<div class="tabulation animate-box">

								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Flights</a>
								      </li>
								      <li role="presentation">
								    	   <a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">Hotels</a>
								      </li>
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
										<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">From:</label>
													<input type="text" name="from" class="form-control" id="from-place" placeholder="Los Angeles, USA" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
													<label for="from">To:</label>
													<input type="text" name="to" class="form-control" id="to-place" placeholder="Tokyo, Japan" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Check In:</label>
													<input type="text" name="check_in" class="form-control" id="date-start" placeholder="mm/dd/yyyy" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Check Out:</label>
													<input type="text" name="check_out" class="form-control" id="date-end" placeholder="mm/dd/yyyy" required/>
												</div>
											</div>
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Class:</label>
													<select class="cs-select cs-skin-border" name="economy">
														<option value="" disabled selected>Economy</option>
														<option value="economy">Economy</option>
														<option value="first">First</option>
														<option value="business">Business</option>
													</select>
												</section>
											</div>
											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" name="searchflight" value="Search Flight">
											</div>
										</div>
										</form>	
									 </div>

									 <div role="tabpanel" class="tab-pane" id="hotels">
									 	<div class="row">
										 <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
											<div class="col-xxs-12 col-xs-12 mt">
												<div class="input-field">
													<label for="from">City:</label>
													<input type="text" name="from" class="form-control" id="from-place" placeholder="Los Angeles, USA" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Return:</label>
													<input type="text" name="to" class="form-control" id="date-start" placeholder="mm/dd/yyyy" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Check Out:</label>
													<input type="text" name="check_out" class="form-control" id="date-end" placeholder="mm/dd/yyyy" required/>
												</div>
											</div>
											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" name="searchhotel" value="Search Hotel">
											</div>
										</form>
										</div>
									 </div>

									
									</div>

								</div>
							</div>
							<style>
							table {
								width: 100%;
								border-collapse: collapse;
								margin-bottom: 20px;
							}
							table, th, td {
								border: 1px solid black;
							}
							th, td {
								padding: 10px;
								text-align: left;
							}
							.action-button {
								background-color: #4CAF50;
								color: white;
								border: none;
								padding: 10px 15px;
								text-align: center;
								cursor: pointer;
							}
							.action-button:hover {
								background-color: #45a049;
							}
						</style>
							<div class="desc2 animate-box">
								<div class="col-sm-7 col-sm-push-1 col-md-7 col-md-push-1">
									<?php
									if (isset($_POST['searchflight'])) {
										$from = $_POST['from'];
										$to = $_POST['to'];
										$check_in = $_POST['check_in'];
										$check_out = $_POST['check_out'];
									
										// Search flights
										$query_flights = "SELECT * FROM flights WHERE from_city='$from' OR to_city='$to' 
														  OR check_in_date='$check_in' OR check_out_date='$check_out'";
										$result_flights = mysqli_query($conn, $query_flights);
											?>
										<?php if ($result_flights && mysqli_num_rows($result_flights) > 0){ ?>
											<h2>Flights</h2>
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
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php while ($row = mysqli_fetch_assoc($result_flights)){ ?>
														<tr>
															<td><?php echo $row['id']; ?></td>
															<td><?php echo $row['from_city']; ?></td>
															<td><?php echo $row['to_city']; ?></td>
															<td><?php echo $row['check_in_date']; ?></td>
															<td><?php echo $row['check_out_date']; ?></td>
															<td><?php echo $row['class']; ?></td>
															<td><?php echo $row['adult_count']; ?></td>
															<td><?php echo $row['children_count']; ?></td>
															<td>$<?php echo $row['price']; ?></td>
															<td><button class="action-button" onclick="bookNow('flight', <?php echo $row['id']; ?>)">Book Now</button></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										<?php }else{ ?>
											<p>No flights found.</p>
										<?php } ?>
										<?php
									}else if(isset($_POST['searchhotel'])){
										$searchotel = $_POST['searchhotel'];
										$from = $_POST['from'];
										$to = $_POST['to'];
										$check_in = $_POST['check_in'];
										$check_out = $_POST['check_out'];

										// Search hotels
											$query_hotels = "SELECT * FROM hotels WHERE city='$from' 
											OR check_out_date='$check_out'";
										$result_hotels = mysqli_query($conn, $query_hotels);
									
									?>
									
								<?php if ($result_hotels && mysqli_num_rows($result_hotels) > 0){ ?>
									<h2>Hotels</h2>
									<table class="table table-responsive">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>City</th>
												<th>Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php while ($row = mysqli_fetch_assoc($result_hotels)){ ?>
												<tr>
													<td><?php echo $row['id']; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['city']; ?></td>
													<td>$<?php echo number_format($row['price']); ?></td>
													<td><button class="action-button" onclick="bookNow('hotel', <?php echo $row['id']; ?>)">Book Now</button></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php }else{ ?>
									<p>No hotels found.</p>
								<?php } }?>

									<h2>Exclusive Limited Time Offer</h2>
									<h3>Fly to Hong Kong via Los Angeles, USA</h3>
									<span class="price">$599</span>
									<!-- <p><a class="btn btn-primary btn-lg" href="#">Get Started</a></p> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<script>
        function bookNow(type, id) {
            if (type === 'flight') {
                alert('Booking flight with ID: ' + id);
                // Redirect to the flight booking page
                window.location.href = 'book_flight.php?id=' + id;
            } else if (type === 'hotel') {
                alert('Booking hotel with ID: ' + id);
                // Redirect to the hotel booking page
                window.location.href = 'book_hotel.php?id=' + id;
            }
        }
    </script>
<?php include_once('footer.php'); ?>