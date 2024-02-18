<?php include("partials-front/menu.php"); ?>


        <!-- fOOD sEARCH Section Starts Here -->
        <section class="food-search">
            <div class="container">

                <h1 class="text-center text-brown">Fill this form to add your reviews.</h1>
    
                <form action="" method="POST" class="order">

                    <fieldset>
                        <legend>Add Reviews</legend>
                        <div class="order-label">Full Name</div>
                        <input type="text" name="name" placeholder="E.g. Safa Rizwan" class="input-responsive">
    
                        <div class="order-label">Score</div>
                        <input type="number" name="score" class="input-responsive">

                        <div class="order-label">Remarks</div>
                        <textarea name="remarks" rows="10" class="input-responsive"></textarea>
    
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary text-brown btn-bg" >
                    </fieldset>
    
                </form>

                <?php
                
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $name = $_POST['name'];
                    $score = $_POST['score'];
                    $remarks = $_POST['remarks'];

                    $sql2 ="INSERT INTO rating(score, remarks, customer_name) VALUES('$score','$remarks','$name')";
                    $res2 = mysqli_query($conn, $sql2);
                    

                    //check whether query executed or not
                    if($res2 ==true)
                    {
                        //query excuted and order saved
                        header('location:'.SITEURL.'reviews.php');
                    }

                    else{
                        //failed to save order
                        
                        header('location:'.SITEURL);
                    }
                }
                ?>

    
            </div>
        </section>
        <!-- fOOD sEARCH Section Ends Here -->



<?php include('partials-front/footer.php'); ?>