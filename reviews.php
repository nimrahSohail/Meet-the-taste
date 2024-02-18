<?php include('partials-front/menu.php'); ?>

    <!-- review section starts  --> 

    <!-- <section class="food-menu color-container"> -->
<section class="review" id="review">

<!-- <a href="add-review.php"><h1 class="text-center">Popular Meal</h1></a> -->
<a href="add-review.php"><h1 class="heading text-center btn btn-primary "> add customer's Reviews</h1></a>

<!-- <div class="container"> -->
    <div class="box-container">
        <?php

        //sql query
        $sql2 = "SELECT * FROM rating";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //count rows to check whether the food is available or not
        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            //reviews is available
            while($row2 = mysqli_fetch_assoc($res2))
            {
                //get the values 
                $id = $row2['id'];
                $customer_name = $row2['customer_name'];
                $score = $row2['score'];
                $remarks = $row2['remarks'];

                ?>

                <div class="box">
                    <h4><?php echo $customer_name;?></h4>
                    <p><?php echo $score; ?></p>
                    <p>
                        <?php echo $remarks; ?>
                    </p>
                    <br>
                </div>
                <?php
                }
            }

            else{
                //food not available
                echo "<div class='error'>Reviews not found.</div>";
            }
            ?>

        <div class="clearfix"></div>
    </div>

        
    
</section>

<!-- review section ends  -->


<?php include('partials-front/footer.php'); ?>