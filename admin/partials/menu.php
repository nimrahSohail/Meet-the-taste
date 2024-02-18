<?php 
include("../config/constants.php");
include("login-check.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
        <title>Meet the taste - Home page</title>
    </head>
    
    <body>
        <!-- MENU SECTION START -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-staff.php">Staff</a></li>
                    <li><a href="manage-menu.php">Menu</a></li>
                    <li><a href="manage-menutype.php">Menu_Type</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="manage-rating.php">Review</a></li>
                    <li><a href="manage-siteinfo.php">Site-information</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>
        <!-- MENU SECTION END -->