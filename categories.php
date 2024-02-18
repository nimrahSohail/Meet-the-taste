<?php include('partials-front/menu.php'); ?>

    <br><br><br>
     <!-- Categories section starts here -->
     <section class="Categories color-container">
        <!-- 1st container for categories -->
        <h1 class="text-center head-bg">Explore Menu</h1>
        <div class="container">


        <?php
            //create sql query to display categories from database
            $sql = "SELECT * FROM  menu WHERE active='yes'";

            //execute the query
            $res = mysqli_query($conn , $sql);

            //count rows to check whether themenu is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //menu is available
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values 
                    $id = $row['id'];
                    $main_course = $row['main_course'];
                    $image_name = $row['image_name'];

                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?menu_id=<?php echo $id;?>">
                    <div class="box-3 float-container">

                    <?php
                        if($image_name=="")
                        {
                            //image not available
                            echo "<div clas='error'>Image not found.</div>";
                        }

                        else{
                            //img available
                            ?>
                                <img src="<?php echo SITEURL;?>images/menu/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        
                        <h3 class="text-brown text-bg text-center"><?php echo $main_course;?></h3>
                    </div>
                </a>
                <?php
                }
            }

            else{
                //menu not available
                echo "<div class='error'>Menu not found.</div>";
            }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Categories section ends here -->  

<?php include('partials-front/footer.php'); ?>