<?php include '../nav/header.php';?>
<link rel="stylesheet" href="../assets/dist/css/style.css">

<div class="container col-xl-10 col-xxl-8 px-4 py-5">
	<div class="row align-items-center g-lg-5 py-5">
		<div class="col-lg-7 text-center text-lg-start">
			<h1 class="display-4 fw-bold lh-1 mb-3"><b>Contact Us!</b></h1>
			<p class="col-lg-10 fs-4">Send us an enquiry or feedback. Your message helps us improve our service for you.</p>
		</div>
		<div class="col-md-10 mx-auto col-lg-5">
			<form action="../model/process_data.php?page=contact" class="p-4 p-md-5 border rounded-3 bg-light" method="post">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" name="name" placeholder="Name (optional)">
					<label>Name (optional)</label>
				</div>
				<div class="form-floating mb-3">
					<textarea class="form-control" name="mssg" placeholder="Message/Feedback" style="height: 100px"></textarea>
					<label>Message/Feedback</label>
				</div>
				<div class="form-floating mb-3">
					<input type="email" class="form-control" name="email" placeholder="Email" required>
					<label>Email</label>
				</div>
				<div class="form-floating mb-3">
					<input type="number" class="form-control" name="contact" placeholder="Contact Number">
					<label>Contact Number</label>
				</div>
				<button class="w-100 btn btn-lg btn-primary" type="submit" name="send_msg">Send</button>
				<hr class="my-4">
				<small class="text-muted">By clicking Send, you agree to our terms of use.</small>
			</form>
		</div>
	</div>
</div>