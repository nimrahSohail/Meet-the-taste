<?php include('partials-front/menu.php'); ?>


    <!-- about section starts here -->
    <section class="about">
        <div class="container">

        <?php

        //sql query
        $sql2 = "SELECT * FROM site_information";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //count rows to check whether the food is available or not
        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            while($row2 = mysqli_fetch_assoc($res2))
            {
                //get the values
                $id = $row2['id'];
                $contact_info = $row2['contact_info'];
                $location = $row2['location'];
                $description = $row2['description'];

                ?>
                    <div class="about-img">
                        <img src="<?php echo SITEURL;?>images/meettaste.jpg" style="width:250px; margin-top:100px; margin-right:20px" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <div class="about-detail">
                        <b><p>Contact_info: <?php echo $contact_info; ?></p></b>
                        <br>
                        <b><p>Current Location: <?php echo $location; ?></p></b>
                        <br>
                        <b><p>About Us: <?php echo $description; ?></p></b>
                        <br>
                    </div>
                <?php
            }
        }

        else{
                //info not available
                echo "<div class='error'>Site-info not found.</div>";
            }
            ?>
            <!-- <h1 class="text-center text-bg">About</h1> -->
                
        
                <div class="clearfix"></div>
            </div>
    </section>

<?php include('partials-front/footer.php'); ?>