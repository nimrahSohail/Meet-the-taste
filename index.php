<?php include('partials-front/menu.php');?>

    <!-- Food Banner section starts here -->
    <section class="food-banner">
        <div class="container"> 
        </div>
    </section>
    <!-- Food Banner section ends here -->

<br>
<br>

<?php
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

    <!-- Categories section starts here -->
    <section class="Categories color-container">
        <!-- 1st container for categories -->
        <h1 class="text-center head-bg">Explore Foods</h1>
        <div class="container">

        <?php
        //create sql query to display menu from database
        $sql = "SELECT * FROM  menu WHERE active='yes' AND featured='yes' LIMIT 3"; //display only 3 menu

        //execute the query
        $res = mysqli_query($conn , $sql);

        //count rows to check whether the menu is available or not
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

                    //check whether image is available or not
                    if($image_name=="")
                    {
                        //display the message 
                        echo "<div class='error'>Image not available.</div>";
                    }
                    else
                    {
                        //image available
                        ?>
                            <img src="<?php echo SITEURL;?>images/menu/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    ?>

                        <h3 class="text-brown text-bg text-center"><?php echo $main_course; ?></h3>
                    </div>
                    </a>

                    <?php
                }
            }

            else{
                //categories not available
                echo "<div class='error'>Menu not added.</div>";
            }
        ?>

            <div class="clearfix"></div>

        </div>


    </section>
    <!-- Categories section ends here -->  


    <!-- Food Menu section starts here -->
    <section class="food-menu color-container">
    <h1 class="text-center">Popular Meal</h1>
        <div class="container">
            
            
            <?php

            //getting menutype from database that are active and featured
            //sql query
            $sql2 = "SELECT * FROM menu_type WHERE active='yes' AND featured='yes' LIMIT 6";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count rows to check whether the food is available or not
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                //menutype is available
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    //get the values 
                    $id = $row2['id'];
                    $type_name = $row2['type_name'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $imagename = $row2['imagename'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">

                        <?php
                        if($imagename=="")
                        {
                            //image not available
                            echo "<div clas='error'>Image not found.</div>";
                        }
                        else{
                            //img available
                            ?>
                                <img src="<?php echo SITEURL;?>images/menu_type/<?php echo $imagename;?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>

                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $type_name;?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
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
    <!-- Food Menu section ends here -->
    <?php include('partials-front/footer.php'); ?>
