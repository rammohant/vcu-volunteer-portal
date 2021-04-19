<html>
<head>
<style type="text/css">

h1 {
    text-align: center;
}
p {
    text-align: center;
}
div {
    text-align: center;
}
body {
 background-image:url('bg.png');
}

</style>

<title>HR database</title>
<?php require_once('header.php'); ?>
</head>
<?php require_once('connection.php'); ?>

<body>

<div class="wrapper"> 
	<h2 align=center style="font-size:30px">VCU Volunteer Database</h2>
	<p align=center style="font-size:15px">For all your volunteering needs and desires</p>
	<div class="container mt-3 mb-3">
		<form method="post">
			<div class="row justify-content-center">
				<div class="col-4">
					<div class="form-group">
						<label>Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>