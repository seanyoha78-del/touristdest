<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require 'config.php'; // connect to DB

    #-----------------------------------------------------------------#
	#--             HomePage carousel feature						--#
	#-----------------------------------------------------------------#
	//get carousel images
	$get_cft_sql = "SELECT * FROM carousel_ft_tb";
	//run query
	$get_cft_query = mysqli_query($conn, $get_cft_sql);
	
	#-----------------------------------------------------------------#
	#--             HomePage hero feature							--#
	#-----------------------------------------------------------------#
	//get hero images
	$get_hft_sql = "SELECT * FROM hero_ft_tb";
	//run query
	$get_hft_query = mysqli_query($conn, $get_hft_sql);
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EasternSamarTD</title>
    <link rel="icon" type="image/x-icon" href="../img/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
		<link rel="manifest" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/manifest.json">
		<link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
		<meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
		<meta name="theme-color" content="#563d7c">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .topbar {
            height: 60px;
            background-color: #f8f9fa;
        }
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
        .img-thumb {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>
<!-- Custom styles for this template -->
<link href="../assets/dist/css/dashboard.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/color-modes.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap4.js"></script>
<body>
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4>MAIN</h4><br>
            <a href="../model/dashboard.php">&#127968 Dashboard</a>
            <a href="../model/inquiry.php">&#128386 Inquiry</a><br>
            <h4>PAGES</h4><br>
            <a href="../model/home.php">&#128196 Home</a>
            <a href="#">&#128196 Services</a>
            <a href="#">&#128196 Contact</a>
            <a href="#">&#128196 Explore</a>
            <a href="#">&#128196 Footer</a>
        </div> 
        <!-- Main Content -->
        <div class="col-md-10">
            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center px-4 topbar bg-dark">
                <h5>Welcome, <?php echo $_SESSION['admin']; ?></h5>
                <a href="logout.php" class="btn btn-danger btn-sm">Sign Out</a>
            </div>

            
           