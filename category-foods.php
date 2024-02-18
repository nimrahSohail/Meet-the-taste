<?php include('partials-front/menu.php'); ?>

<?php
//check whether id is passed or not
if(isset($_GET['menu_id']))
{
    //cat id is set and get the id
    $menu_id = $_GET['menu_id'];
    //get the category title based on category id
    $sql = "SELECT main_course FROM menu WHERE id=$menu_id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //get the value from db
    $row = mysqli_fetch_assoc($res);

    //get the title
    $menu_title = $row['main_course'];
}
else{
    //category not present
    //redirect to homw page
    header('location:'.SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <h2>Foods on <a href="#" class="text-white">"<?php echo $menu_title;?>"</a></h2>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu color-container">
    <!-- <h2 class="text-center">Food Menu</h2> -->
        <div class="container">
            

            <?php

            //create sql query to get foods based on selected cat
            $sql2 = "SELECT * FROM menu_type WHERE menu_id=$menu_id";

            //execute
            $res2 = mysqli_query($conn, $sql2);

            //count the rows
            $count2 = mysqli_num_rows($res2);

            //checdk whether food is available or not
            if($count2>0)
            {
                //food is availabe
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $type_name = $row2['type_name'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $imagename = $row2['imagename'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                        <?php

                            //check whether image is available or not
                            if($imagename=="")
                            {
                                //display the message 
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL;?>images/menu_type/<?php echo $imagename;?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>

                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $type_name; ?></h4>
                            <p class="food-price">$<?php echo $price;?></p>
                            <p class="food-detail">
                                <?php echo $description;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?menutype_id=<?php echo $id;?>" class="btn btn-primary btn btn-bg">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                //food not available
                echo "<div class='error'>Menutype not found.</div>";
            }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>