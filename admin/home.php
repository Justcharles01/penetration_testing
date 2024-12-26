<?php include_once('header.php'); ?>
<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Admin Dashboard</h3>
						<p>Here you have the overview of the whole system!</p>
					</div>
				</div>
				<div class="row row-bottom-padded-md">
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-1.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Total Users</h3>
								<span class="price">
								<?php
									$query = "SELECT * FROM users";
									$result = mysqli_query($conn, $query);
									echo mysqli_num_rows($result);
									?>
								</span>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-2.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Total Bookings</h3>
								<span class="price">120</span>
								<a class="btn btn-primary btn-outline" href="#">View Now <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-3.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Total Flights</h3>
								<span class="price">
								<?php
									$query = "SELECT * FROM flights";
									$result = mysqli_query($conn, $query);
									echo mysqli_num_rows($result);
									?>
								</span>
								<a class="btn btn-primary btn-outline" href="flights.php">View Now <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-1.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Total Hotels</h3>
								<span class="price">
									<?php
									$query = "SELECT * FROM hotels";
									$result = mysqli_query($conn, $query);
									echo mysqli_num_rows($result);
									?>
								</span>
								<a class="btn btn-primary btn-outline" href="hotels.php">View Now <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="../images/place-2.jpg" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<span></span>
								<h3>Total Packages</h3>
								<span class="price">65</span>
								<a class="btn btn-primary btn-outline" href="#">View Now <i class="icon-arrow-right22"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include_once('footer.php'); ?>
