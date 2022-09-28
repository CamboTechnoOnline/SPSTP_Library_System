<!DOCTYPE html>
<html>
<head>
	<title>ប្រព័ន្ធគ្រប់គ្រងបណ្ណាល័យ</title>
</head>
<body>
	<?php require('headerhomepage.php'); ?>
	<div class="container">

		<div class="cotainer" style="margin-top: 20px;">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header"​ style="font-family:Moul;color: #2B3990;  font-size: 20px; text-align: center;">អានច្រើនកើនចំណេះដឹង</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
										<div class="carousel-indicators">
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
										</div>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img src="image/1.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="image/2.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="image/3.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="image/3.jpg" class="d-block w-100" alt="...">
											</div>
										</div>
										<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div>
								</div>


								<div class="col-md-4">
									<div class="card" style="width: auto;">
										<div class="card-header"><b>ម៉ោងធ្វើការ ៖ </b></div>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">* ពេលព្រឹក</li>
											<li class="list-group-item">ម៉ោង ០៧:០០ ព្រឹក ដល់ ១១:០០ ព្រឹក</li>
											<li class="list-group-item">* ពេលរសៀល</li>
											<li class="list-group-item">ម៉ោង ១:០០ រសៀល ដល់ ០៥:០០ ល្ងាច</li>
										</ul>
									</div>
									<br>
									<div class="card" style="width: auto;">
										<div class="card-header"><b>ទំនាក់ទំនងបណ្ណារ័ក្ស ៖</b></div>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">* បណ្ណារ័ក្សឈ្មោះ ៖
											 </li>
											<li class="list-group-item">&nbsp;&nbsp;
											<b>
												<?php 
						    						include('db.php');
						                            $sql = ("Select * from tbluser where user_type='user';");
						                            $result = $conn->query($sql); 
						                            while($row=$result->fetch_assoc()){
						                              echo  ( $row['name'] ) ;
						                          	}
						                         ?>
						                    </b>
											</li>
											<li class="list-group-item">* លេខទំនាក់ទំនង</li>
											<li class="list-group-item">&nbsp;&nbsp;
											<b>
												<?php 
						    						include('db.php');
						                            $sql = ("Select * from tbluser where user_type='user';");
						                            $result = $conn->query($sql); 
						                            while($row=$result->fetch_assoc()){
						                              echo  ( $row['phone'] ) ;
						                          	}
						                         ?>
						                    </b>
											</li>
										</ul>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>




				
			</div>
		</div>


	</div>
	<?php include('footerhomepage.php')?>
</body>
</html>