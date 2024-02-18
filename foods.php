<?php include('partials-front/menu.php'); ?>

    <!-- Food Banner section starts here -->
    <section class="food-banner">
        <div class="container"> 
        </div>

    </section>
    <!-- Food Banner section ends here -->

    <!-- Food Menu section starts here -->
    <section class="food-menu color-container">
        <h1 class="text-center">Available Meal</h1>
        <div class="container">
            
        <?php
        
        //create sql query to display food from database
        $sql = "SELECT * FROM  menu_type WHERE active='yes'"; 

        //execute the query
        $res = mysqli_query($conn , $sql);

        //count rows to check whether the cat is available or not
        $count = mysqli_num_rows($res);

        if($count>0)
        {
            //food is available
            while($row = mysqli_fetch_assoc($res))
            {
                //get the values 
                $id = $row['id'];
                $type_name = $row['type_name'];
                $description = $row['description'];
                $price = $row['price'];
                $imagename = $row['imagename'];

                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                    
                <?php
                if($imagename=="")
                {
                    //image not available
                    echo "<div class='error'>Image not found.</div>";
                }
                else{
                    //img available
                    ?>
                        <img src="<?php echo SITEURL;?>images/menu_type/<?php echo $imagename;?>" alt="Pizza" class="img-responsive img-curve">
                    <?php
                }

                ?>

                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $type_name;?></h4>
                    <p class="food-price"><?php echo '$'.$price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?menutype_id=<?php echo $id;?>" class="btn btn-primary btn btn-bg">Order Now</a>
                </div>
            </div>
            <?php
            }
        }

        else{
            //food not available
            echo "<div class='error'>Menutype not found.</div>";
        }
        ?>


        <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

