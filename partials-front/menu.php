<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet the Taste</title>

    <!-- CSS file linikng -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/css/about.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mediaqueries.css?v=<?php echo time(); ?>">

    <!-- Bootstrap linking
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    
</head>

<body>
    <!-- navbar section starts here -->
    <section class="navbar">
        
        <div class="container1">
            <div class="logo">
                <img src="images/logo.jpg" alt="Restaurant food" class="img-responsive">
            </div>
            <div class="menu text-center">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                    </li>

                    <li>
                        <a href="<?php echo SITEURL;?>foods.php">Foods</a>
                    </li>

                    <li>
                        <a href="<?php echo SITEURL; ?>reviews.php">Reviews</a>
                    </li>

                    <li>
                        <a href="<?php echo SITEURL;?>about.php">About us</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- navbar section ends here -->